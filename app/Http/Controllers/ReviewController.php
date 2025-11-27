<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please login to write a review');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        try {
            Review::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'rating' => $validated['rating'],
                'comment' => $validated['comment'],
            ]);

            return back()->with('success', 'Review submitted successfully!');
        } catch (\Exception $e) {
            // Log the actual error for debugging
            Log::error('Review submission failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to submit review: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Review $review)
    {
        if (!Auth::check() || $review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:10|max:1000',
        ]);

        try {
            $review->update($validated);
            return back()->with('success', 'Review updated successfully!');
        } catch (\Exception $e) {
            Log::error('Review update failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to update review: ' . $e->getMessage());
        }
    }

    public function destroy(Review $review)
    {
        if (!Auth::check() || $review->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action');
        }

        try {
            $review->delete();
            return back()->with('success', 'Review deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Review deletion failed: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete review: ' . $e->getMessage());
        }
    }
}
