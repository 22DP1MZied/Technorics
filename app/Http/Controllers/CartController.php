<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('product')
            ->where(function($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    $query->where('session_id', session()->getId());
                }
            })
            ->get();

        $subtotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });

        $tax = $subtotal * 0.21; // 21% VAT
        $shipping = $subtotal > 100 ? 0 : 10;
        $total = $subtotal + $tax + $shipping;

        return view('cart.index', compact('cartItems', 'subtotal', 'tax', 'shipping', 'total'));
    }

    public function add(Product $product, Request $request)
    {
        $quantity = $request->input('quantity', 1);

        $cartItem = CartItem::where('product_id', $product->id)
            ->where(function($query) {
                if (Auth::check()) {
                    $query->where('user_id', Auth::id());
                } else {
                    $query->where('session_id', session()->getId());
                }
            })
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'session_id' => Auth::check() ? null : session()->getId(),
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->discount_price ?? $product->price,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(CartItem $cartItem, Request $request)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function clear()
    {
        CartItem::where(function($query) {
            if (Auth::check()) {
                $query->where('user_id', Auth::id());
            } else {
                $query->where('session_id', session()->getId());
            }
        })->delete();

        return redirect()->route('home')->with('success', 'Cart cleared!');
    }
}
