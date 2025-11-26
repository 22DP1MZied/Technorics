<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = Review::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

        // Update product average rating
        $avgRating = $product->reviews()->avg('rating');
        $reviewsCount = $product->reviews()->count();
        
        $product->update([
            'rating' => round($avgRating, 1),
            'reviews_count' => $reviewsCount,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403);
        }

        $product = $review->product;
        $review->delete();

        // Update product rating
        $avgRating = $product->reviews()->avg('rating') ?? 0;
        $reviewsCount = $product->reviews()->count();
        
        $product->update([
            'rating' => round($avgRating, 1),
            'reviews_count' => $reviewsCount,
        ]);

        return back()->with('success', 'Review deleted successfully!');
    }
}
