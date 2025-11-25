@auth
<button 
    onclick="toggleWishlist({{ $product->id }}, this)"
    class="wishlist-btn absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition shadow-lg group"
    data-product-id="{{ $product->id }}"
    data-in-wishlist="{{ $inWishlist ? 'true' : 'false' }}">
    <svg class="w-5 h-5 {{ $inWishlist ? 'text-red-500 fill-current' : 'text-gray-600' }} group-hover:scale-110 transition" fill="{{ $inWishlist ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
    </svg>
</button>

<script>
function toggleWishlist(productId, button) {
    const isInWishlist = button.getAttribute('data-in-wishlist') === 'true';
    const heartIcon = button.querySelector('svg');
    
    // Optimistic UI update
    if (isInWishlist) {
        heartIcon.classList.remove('text-red-500', 'fill-current');
        heartIcon.classList.add('text-gray-600');
        heartIcon.setAttribute('fill', 'none');
        button.setAttribute('data-in-wishlist', 'false');
    } else {
        heartIcon.classList.remove('text-gray-600');
        heartIcon.classList.add('text-red-500', 'fill-current');
        heartIcon.setAttribute('fill', 'currentColor');
        button.setAttribute('data-in-wishlist', 'true');
    }
    
    // Send request
    const url = isInWishlist 
        ? `/wishlist/remove-by-product/${productId}`
        : `/wishlist/add/${productId}`;
    
    const method = isInWishlist ? 'DELETE' : 'POST';
    
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(data.message, 'success');
        } else {
            // Revert on error
            if (!isInWishlist) {
                heartIcon.classList.remove('text-red-500', 'fill-current');
                heartIcon.classList.add('text-gray-600');
                heartIcon.setAttribute('fill', 'none');
                button.setAttribute('data-in-wishlist', 'false');
            } else {
                heartIcon.classList.remove('text-gray-600');
                heartIcon.classList.add('text-red-500', 'fill-current');
                heartIcon.setAttribute('fill', 'currentColor');
                button.setAttribute('data-in-wishlist', 'true');
            }
            showToast('Error: ' + (data.message || 'Something went wrong'), 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Revert on error
        if (!isInWishlist) {
            heartIcon.classList.remove('text-red-500', 'fill-current');
            heartIcon.classList.add('text-gray-600');
            heartIcon.setAttribute('fill', 'none');
            button.setAttribute('data-in-wishlist', 'false');
        } else {
            heartIcon.classList.remove('text-gray-600');
            heartIcon.classList.add('text-red-500', 'fill-current');
            heartIcon.setAttribute('fill', 'currentColor');
            button.setAttribute('data-in-wishlist', 'true');
        }
        showToast('Network error. Please try again.', 'error');
    });
}

function showToast(message, type) {
    const toast = document.createElement('div');
    toast.className = `fixed top-24 right-4 px-6 py-3 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-emerald-600' : 'bg-red-600'
    } text-white font-semibold animate-slide-in`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(100%)';
        toast.style.transition = 'all 0.3s ease';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>

<style>
@keyframes slide-in {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

.animate-slide-in {
    animation: slide-in 0.3s ease-out;
}
</style>
@else
<a href="{{ route('login') }}" class="absolute top-4 right-4 w-10 h-10 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white transition shadow-lg">
    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
    </svg>
</a>
@endauth
