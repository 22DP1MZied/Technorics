<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        
        // Get store context
        $storeContext = $this->getStoreContext();
        
        // System prompt
        $systemPrompt = "You are the Technorics AI Shopping Assistant. You help customers with:

1. **Product Recommendations**: Suggest products based on budget, needs, and preferences
2. **PC Building**: Help customers build custom PC configurations within their budget
3. **Product Information**: Answer questions about specifications, compatibility, availability
4. **Store Policies**: Explain shipping, returns, warranties, and policies
5. **Order Help**: Assist with tracking orders, checkout process
6. **Navigation**: Help users find products or pages on the site

**CRITICAL RULES:**
- ONLY answer questions related to Technorics store, products, policies, or shopping
- If asked about anything NOT related to the store (weather, news, general knowledge, other topics), respond: \"I'm the Technorics shopping assistant and can only help with store-related questions. Is there anything about our products or services I can help you with?\"
- Be friendly, helpful, and concise
- When recommending products, mention prices in Euros (€)
- For PC builds, ensure compatibility between components

**Current Store Inventory:**
$storeContext

Be helpful and guide customers to make informed purchases!";

        try {
            $response = Http::timeout(30)->post('https://api.anthropic.com/v1/messages', [
                'model' => 'claude-sonnet-4-20250514',
                'max_tokens' => 1024,
                'system' => $systemPrompt,
                'messages' => $messages,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return response()->json([
                    'success' => true,
                    'message' => $data['content'][0]['text'] ?? 'No response',
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to get response from AI assistant',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function getStoreContext()
    {
        $categories = Category::withCount('products')->get();
        $products = Product::where('is_active', true)
            ->select('name', 'category_id', 'price', 'discount_price', 'brand', 'stock')
            ->get()
            ->groupBy('category_id');

        $context = "**Categories & Products:**\n\n";
        
        foreach ($categories as $category) {
            $context .= "**{$category->name}** ({$category->products_count} products):\n";
            
            $categoryProducts = $products->get($category->id, collect());
            foreach ($categoryProducts->take(10) as $product) {
                $price = $product->discount_price ?? $product->price;
                $context .= "- {$product->name} by {$product->brand}: €" . number_format($price, 2);
                if ($product->discount_price) {
                    $context .= " (was €" . number_format($product->price, 2) . ")";
                }
                $context .= " - " . ($product->stock > 0 ? "In Stock" : "Out of Stock") . "\n";
            }
            $context .= "\n";
        }

        $context .= "\n**Store Policies:**\n";
        $context .= "- Free shipping on orders over €100\n";
        $context .= "- 30-day return policy\n";
        $context .= "- 1-year warranty on all products\n";
        $context .= "- Multiple payment methods accepted\n";

        return $context;
    }
}
