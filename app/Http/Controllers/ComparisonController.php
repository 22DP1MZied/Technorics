<?php

namespace App\Http\Controllers;

use App\Models\Comparison;
use App\Models\Product;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function index()
    {
        $comparisons = $this->getUserComparisons()
            ->with('product.category')
            ->get();
        
        $products = $comparisons->pluck('product');
        
        return view('comparison.index', compact('products'));
    }

    public function add(Product $product)
    {
        $count = $this->getUserComparisons()->count();
        
        if ($count >= 4) {
            return response()->json([
                'success' => false,
                'message' => 'Maximum 4 products can be compared'
            ]);
        }

        $exists = $this->getUserComparisons()
            ->where('product_id', $product->id)
            ->exists();
        
        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'Product already in comparison'
            ]);
        }

        Comparison::create([
            'user_id' => auth()->id(),
            'session_id' => session()->getId(),
            'product_id' => $product->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Added to comparison!',
            'count' => $this->getUserComparisons()->count()
        ]);
    }

    public function remove(Product $product)
    {
        $this->getUserComparisons()
            ->where('product_id', $product->id)
            ->delete();

        return response()->json([
            'success' => true,
            'message' => 'Removed from comparison!',
            'count' => $this->getUserComparisons()->count()
        ]);
    }

    public function clear()
    {
        $this->getUserComparisons()->delete();
        
        return redirect()->route('store.index')->with('success', 'Comparison cleared!');
    }

    private function getUserComparisons()
    {
        return Comparison::where(function($query) {
            if (auth()->check()) {
                $query->where('user_id', auth()->id());
            } else {
                $query->where('session_id', session()->getId());
            }
        });
    }
}
