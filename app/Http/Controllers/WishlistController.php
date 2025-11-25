<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = Wishlist::where('user_id', auth()->id())
            ->with('product.category')
            ->get();
        
        return view('wishlist.index', compact('wishlistItems'));
    }

    public function add(Product $product)
    {
        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->exists();
        
        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Product already in wishlist'
            ]);
        }
        
        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Added to wishlist!'
        ]);
    }

    public function remove(Wishlist $wishlist)
    {
        if ($wishlist->user_id !== auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized'
            ], 403);
        }
        
        $wishlist->delete();
        
        return redirect()->route('wishlist.index')->with('success', 'Removed from wishlist');
    }

    public function removeByProduct($productId)
    {
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $productId)
            ->first();
        
        if (!$wishlist) {
            return response()->json([
                'success' => false,
                'message' => 'Product not in wishlist'
            ]);
        }
        
        $wishlist->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Removed from wishlist!'
        ]);
    }
}
