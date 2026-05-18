<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Category;

class AiAssistantController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate([
            'messages' => 'required|array',
            'messages.*.role' => 'required|in:user,assistant',
            'messages.*.content' => 'required|string',
        ]);

        $messages = $request->input('messages');
        $storeContext = $this->getStoreContext();
        $productFormat = '[{"id": 1, "name": "Product Name", "reason": "Short reason"}]';
        $addFormat = '[{"id": 1}, {"id": 2}]';

        $systemPrompt = "You are Technorics AI Shopping Assistant.\n"
            . "RULES:\n"
            . "- Only answer about Technorics store and products\n"
            . "- Be concise, max 150 words per response\n"
            . "- Recommend max 4 products at a time\n"
            . "- Prices in EUR\n\n"
            . "PRODUCT SUGGESTIONS: When recommending products, add this at the END:\n"
            . "<products>\n" . $productFormat . "\n</products>\n\n"
            . "ADD TO CART: If the user says they want to add products to cart (e.g. 'ieliec grozā', 'add to cart', 'добавь в корзину'), add this at the END:\n"
            . "<add_to_cart>\n" . $addFormat . "\n</add_to_cart>\n\n"
            . "Use exact product IDs from inventory. Only add products that were previously recommended.\n\n"
            . "INVENTORY:\n" . $storeContext;

        try {
            $apiKey = env('GROQ_API_KEY');
            if (!$apiKey) {
                return response()->json(['success' => false, 'message' => 'API key not configured.'], 500);
            }

            $recentMessages = array_slice($messages, -6);
            $apiMessages = [['role' => 'system', 'content' => $systemPrompt]];
            foreach ($recentMessages as $msg) {
                $apiMessages[] = ['role' => $msg['role'], 'content' => mb_substr($msg['content'], 0, 500)];
            }

            $response = Http::timeout(30)
                ->withHeaders(['Authorization' => 'Bearer ' . $apiKey, 'Content-Type' => 'application/json'])
                ->post('https://api.groq.com/openai/v1/chat/completions', [
                    'model' => 'llama-3.3-70b-versatile',
                    'messages' => $apiMessages,
                    'max_tokens' => 500,
                    'temperature' => 0.7,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $rawMessage = $data['choices'][0]['message']['content'] ?? 'No response';

                // Produktu ieteikumi
                $suggestedProducts = [];
                if (preg_match('/<products>(.*?)<\/products>/s', $rawMessage, $matches)) {
                    $decoded = json_decode(trim($matches[1]), true);
                    if (is_array($decoded)) {
                        foreach ($decoded as $item) {
                            $product = Product::find($item['id'] ?? null);
                            if ($product) {
                                $suggestedProducts[] = [
                                    'id' => $product->id,
                                    'name' => $product->name,
                                    'price' => $product->discount_price ?? $product->price,
                                    'original_price' => $product->discount_price ? $product->price : null,
                                    'image' => $product->image_url,
                                    'reason' => $item['reason'] ?? '',
                                    'in_stock' => $product->stock > 0,
                                ];
                            }
                        }
                    }
                }

                // Automātiska pievienošana grozam
                $addedProducts = [];
                if (preg_match('/<add_to_cart>(.*?)<\/add_to_cart>/s', $rawMessage, $matches)) {
                    $decoded = json_decode(trim($matches[1]), true);
                    if (is_array($decoded)) {
                        foreach ($decoded as $item) {
                            $product = Product::find($item['id'] ?? null);
                            if ($product && $product->stock > 0) {
                                $cartItem = \App\Models\CartItem::where('product_id', $product->id)
                                    ->where(function ($query) {
                                        if (\Auth::check()) {
                                            $query->where('user_id', \Auth::id());
                                        } else {
                                            $query->where('session_id', session()->getId());
                                        }
                                    })->first();

                                if ($cartItem) {
                                    $cartItem->quantity += 1;
                                    $cartItem->save();
                                } else {
                                    \App\Models\CartItem::create([
                                        'user_id' => \Auth::id(),
                                        'session_id' => \Auth::check() ? null : session()->getId(),
                                        'product_id' => $product->id,
                                        'quantity' => 1,
                                        'price' => $product->discount_price ?? $product->price,
                                    ]);
                                }
                                $addedProducts[] = $product->name;
                            }
                        }
                    }
                }

                $cleanMessage = trim(preg_replace('/<products>.*?<\/products>/s', '', $rawMessage));
                $cleanMessage = trim(preg_replace('/<add_to_cart>.*?<\/add_to_cart>/s', '', $cleanMessage));

                $cartCount = \App\Models\CartItem::where(function ($query) {
                    if (\Auth::check()) {
                        $query->where('user_id', \Auth::id());
                    } else {
                        $query->where('session_id', session()->getId());
                    }
                })->sum('quantity');

                return response()->json([
                    'success' => true,
                    'message' => $cleanMessage,
                    'suggested_products' => $suggestedProducts,
                    'added_to_cart' => $addedProducts,
                    'cart_count' => $cartCount,
                ]);
            } else {
                Log::error('Groq API Error', ['status' => $response->status(), 'body' => $response->body()]);
                return response()->json(['success' => false, 'message' => 'Sorry, I encountered an error. Please try again.'], 500);
            }
        } catch (\Exception $e) {
            Log::error('Exception in AI chat', ['error' => $e->getMessage()]);
            return response()->json(['success' => false, 'message' => 'Sorry, I encountered an error. Please try again.'], 500);
        }
    }

    public function addToCart(Request $request)
    {
        $request->validate(['product_id' => 'required|integer|exists:products,id']);

        $product = Product::findOrFail($request->product_id);

        $cartItem = \App\Models\CartItem::where('product_id', $product->id)
            ->where(function ($query) {
                if (\Auth::check()) {
                    $query->where('user_id', \Auth::id());
                } else {
                    $query->where('session_id', session()->getId());
                }
            })->first();

        if ($cartItem) {
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            \App\Models\CartItem::create([
                'user_id' => \Auth::id(),
                'session_id' => \Auth::check() ? null : session()->getId(),
                'product_id' => $product->id,
                'quantity' => 1,
                'price' => $product->discount_price ?? $product->price,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Produkts pievienots grozam!',
            'cart_count' => \App\Models\CartItem::where(function ($query) {
                if (\Auth::check()) {
                    $query->where('user_id', \Auth::id());
                } else {
                    $query->where('session_id', session()->getId());
                }
            })->sum('quantity'),
        ]);
    }

    private function getStoreContext()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::where('is_active', true)
            ->select('id', 'name', 'category_id', 'price', 'discount_price', 'brand', 'stock')
            ->get()->groupBy('category_id');

        $context = '';
        foreach ($categories as $category) {
            $context .= $category->name . ":\n";
            foreach ($products->get($category->id, collect())->take(3) as $product) {
                $price = $product->discount_price ?? $product->price;
                $context .= '- [ID:' . $product->id . '] ' . $product->name . ' by ' . $product->brand . ': EUR ' . number_format($price, 2);
                $context .= ' - ' . ($product->stock > 0 ? 'In Stock' : 'Out of Stock') . "\n";
            }
            $context .= "\n";
        }
        $context .= "Policies: Free shipping over EUR 100, 30-day returns, 1-year warranty.\n";
        return $context;
    }
}
