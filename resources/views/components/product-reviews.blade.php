<div class="bg-white dark:bg-gray-800 rounded-xl p-6 shadow-sm">
    <!-- Reviews Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2">Customer Reviews</h2>
            @if($reviews->count() > 0)
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= $averageRating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                    <span class="text-2xl font-bold text-gray-900 dark:text-white">{{ number_format($averageRating, 1) }}</span>
                </div>
                <span class="text-gray-600 dark:text-gray-400">Based on {{ $reviews->count() }} {{ $reviews->count() === 1 ? 'review' : 'reviews' }}</span>
            </div>
            @else
            <p class="text-gray-600 dark:text-gray-400">No reviews yet. Be the first to review!</p>
            @endif
        </div>
        
        @auth
        <button onclick="document.getElementById('review-form').scrollIntoView({behavior: 'smooth'})" class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
            Write a Review
        </button>
        @else
        <a href="{{ route('login') }}" class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
            Login to Review
        </a>
        @endauth
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-lg p-4 mb-6">
        <p class="text-emerald-800 dark:text-emerald-200">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4 mb-6">
        <p class="text-red-800 dark:text-red-200">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Review Form -->
    @auth
    <div id="review-form" class="mb-8 p-6 bg-gray-50 dark:bg-gray-900 rounded-lg">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Write Your Review</h3>
        <form action="{{ route('reviews.store', $product) }}" method="POST" class="space-y-4">
            @csrf
            
            <!-- Star Rating -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Rating *</label>
                <div class="flex gap-2" id="star-rating-input">
                    @for($i = 1; $i <= 5; $i++)
                    <button type="button" onclick="setRating({{ $i }})" class="star-button focus:outline-none">
                        <svg class="w-10 h-10 text-gray-300 transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20" data-star="{{ $i }}">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </button>
                    @endfor
                </div>
                <input type="hidden" name="rating" id="rating-value" value="5" required>
                @error('rating')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Comment -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Your Review * (minimum 10 characters)</label>
                <textarea name="comment" id="review-comment" rows="4" required minlength="10" maxlength="1000"
                    placeholder="Share your experience with this product..."
                    class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">{{ old('comment') }}</textarea>
                @error('comment')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Characters: <span id="char-count">0</span>/1000</p>
            </div>

            <button type="submit" class="px-6 py-3 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
                Submit Review
            </button>
        </form>
    </div>
    @endauth

    <!-- Reviews List -->
    @if($reviews->count() > 0)
    <div class="space-y-6">
        @foreach($reviews as $review)
        <div class="border-b dark:border-gray-700 pb-6 last:border-b-0" id="review-{{ $review->id }}">
            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center">
                        <span class="text-emerald-600 font-bold text-lg">{{ strtoupper(substr($review->user->name, 0, 1)) }}</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 dark:text-white">{{ $review->user->name }}</h4>
                        <div class="flex items-center gap-2">
                            <div class="flex">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300 dark:text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                            <span class="text-sm text-gray-600 dark:text-gray-400">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                @auth
                @if($review->user_id === Auth::id())
                <div class="flex gap-2">
                    <button onclick="toggleEditForm({{ $review->id }})" class="text-blue-600 hover:text-blue-700 text-sm font-semibold">
                        Edit
                    </button>
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-semibold">
                            Delete
                        </button>
                    </form>
                </div>
                @endif
                @endauth
            </div>

            <!-- Review Comment -->
            <p class="text-gray-700 dark:text-gray-300 leading-relaxed" id="review-comment-{{ $review->id }}">{{ $review->comment }}</p>

            <!-- Edit Form (Hidden by default) -->
            @auth
            @if($review->user_id === Auth::id())
            <div id="edit-form-{{ $review->id }}" class="hidden mt-4 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                <form action="{{ route('reviews.update', $review) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Rating *</label>
                        <div class="flex gap-2" id="edit-star-rating-{{ $review->id }}">
                            @for($i = 1; $i <= 5; $i++)
                            <button type="button" onclick="setEditRating({{ $review->id }}, {{ $i }})" class="focus:outline-none">
                                <svg class="w-8 h-8 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }} transition-colors duration-150" fill="currentColor" viewBox="0 0 20 20" data-edit-star="{{ $i }}">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </button>
                            @endfor
                        </div>
                        <input type="hidden" name="rating" id="edit-rating-value-{{ $review->id }}" value="{{ $review->rating }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Your Review *</label>
                        <textarea name="comment" rows="3" required minlength="10" maxlength="1000"
                            class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg focus:border-emerald-600 focus:outline-none">{{ $review->comment }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg font-semibold hover:bg-emerald-700 transition">
                            Update Review
                        </button>
                        <button type="button" onclick="toggleEditForm({{ $review->id }})" class="px-4 py-2 bg-gray-300 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-lg font-semibold hover:bg-gray-400 dark:hover:bg-gray-600 transition">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
            @endif
            @endauth
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-12">
        <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">No Reviews Yet</h3>
        <p class="text-gray-600 dark:text-gray-400 mb-4">Be the first to share your thoughts about this product!</p>
    </div>
    @endif
</div>

<script>
// Character counter for review form
const commentField = document.getElementById('review-comment');
if (commentField) {
    commentField.addEventListener('input', function(e) {
        document.getElementById('char-count').textContent = e.target.value.length;
    });
}

// Set rating for new review - highlights all stars up to clicked star
function setRating(rating) {
    document.getElementById('rating-value').value = rating;
    const stars = document.querySelectorAll('#star-rating-input svg');
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.remove('text-gray-300');
            star.classList.add('text-yellow-400');
        } else {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-gray-300');
        }
    });
}

// Set rating for edit review - highlights all stars up to clicked star
function setEditRating(reviewId, rating) {
    document.getElementById(`edit-rating-value-${reviewId}`).value = rating;
    const stars = document.querySelectorAll(`#edit-star-rating-${reviewId} svg`);
    stars.forEach((star, index) => {
        if (index < rating) {
            star.classList.remove('text-gray-300');
            star.classList.add('text-yellow-400');
        } else {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-gray-300');
        }
    });
}

// Initialize stars on page load (set to 5 stars by default)
document.addEventListener('DOMContentLoaded', function() {
    setRating(5);
});

// Toggle edit form
function toggleEditForm(reviewId) {
    const editForm = document.getElementById(`edit-form-${reviewId}`);
    const comment = document.getElementById(`review-comment-${reviewId}`);
    
    if (editForm.classList.contains('hidden')) {
        editForm.classList.remove('hidden');
        comment.classList.add('hidden');
    } else {
        editForm.classList.add('hidden');
        comment.classList.remove('hidden');
    }
}
</script>
