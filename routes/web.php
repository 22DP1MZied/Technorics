<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

// Homepage
Route::get('/', [HomeController::class, 'index'])->name('home');

// Store Routes
Route::prefix('store')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('store.index');
    Route::get('/product/{slug}', [StoreController::class, 'show'])->name('store.product');
    Route::get('/category/{slug}', [StoreController::class, 'category'])->name('store.category');
    Route::get('/search', [StoreController::class, 'search'])->name('store.search');
});

// Deals Route
Route::get('/deals', [StoreController::class, 'deals'])->name('store.deals');

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// Checkout Routes (require authentication)
Route::middleware(['auth'])->prefix('checkout')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('checkout.confirmation');
});

// Wishlist Routes (require authentication)
Route::middleware(['auth'])->prefix('wishlist')->group(function () {
    Route::get('/', [\App\Http\Controllers\WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/add/{product}', [\App\Http\Controllers\WishlistController::class, 'add'])->name('wishlist.add');
    Route::delete('/remove/{wishlist}', [\App\Http\Controllers\WishlistController::class, 'remove'])->name('wishlist.remove');
});

// Orders Routes (require authentication)
Route::middleware(['auth'])->prefix('orders')->group(function () {
    Route::get('/', [\App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
    Route::get('/{order}', [\App\Http\Controllers\OrderController::class, 'show'])->name('orders.show');
});

// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile/password', [\App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// Authentication Routes (from Breeze)
require __DIR__.'/auth.php';

// Pages Routes
Route::prefix('pages')->name('pages.')->group(function () {
    Route::get('/contact', [\App\Http\Controllers\PagesController::class, 'contact'])->name('contact');
    Route::get('/track-order', [\App\Http\Controllers\PagesController::class, 'trackOrder'])->name('track-order');
    Route::get('/returns', [\App\Http\Controllers\PagesController::class, 'returns'])->name('returns');
    Route::get('/shipping', [\App\Http\Controllers\PagesController::class, 'shipping'])->name('shipping');
    Route::get('/about', [\App\Http\Controllers\PagesController::class, 'about'])->name('about');
    Route::get('/careers', [\App\Http\Controllers\PagesController::class, 'careers'])->name('careers');
    Route::get('/press', [\App\Http\Controllers\PagesController::class, 'press'])->name('press');
    Route::get('/blog', [\App\Http\Controllers\PagesController::class, 'blog'])->name('blog');
});

// AI Assistant Route
Route::post('/api/ai-assistant/chat', [\App\Http\Controllers\AiAssistantController::class, 'chat'])->name('ai.chat');

// Profile Routes (require authentication)
Route::middleware(['auth'])->prefix('profile')->group(function () {
    Route::get('/', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::get('/password', [\App\Http\Controllers\ProfileController::class, 'password'])->name('profile.password');
    Route::put('/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

// Additional wishlist route for AJAX removal
Route::middleware(['auth'])->delete('/wishlist/remove-by-product/{product}', [\App\Http\Controllers\WishlistController::class, 'removeByProduct'])->name('wishlist.removeByProduct');

// Comparison Routes
Route::prefix('compare')->name('compare.')->group(function () {
    Route::get('/', [\App\Http\Controllers\ComparisonController::class, 'index'])->name('index');
    Route::post('/add/{product}', [\App\Http\Controllers\ComparisonController::class, 'add'])->name('add');
    Route::delete('/remove/{product}', [\App\Http\Controllers\ComparisonController::class, 'remove'])->name('remove');
    Route::delete('/clear', [\App\Http\Controllers\ComparisonController::class, 'clear'])->name('clear');
    Route::get('/count', function() {
        $count = \App\Models\Comparison::where(function($query) {
            if (auth()->check()) {
                $query->where('user_id', auth()->id());
            } else {
                $query->where('session_id', session()->getId());
            }
        })->count();
        return response()->json(['count' => $count]);
    })->name('count');
});

// Review Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::post('/products/{product}/reviews', [\App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    Route::delete('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Language Switcher
Route::get('/language/{locale}', [\App\Http\Controllers\LanguageController::class, 'switch'])->name('language.switch');

// Profile Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function() {
        return view('profile.show');
    })->name('profile.show');
    
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
});

// Track Order Routes
Route::get('/pages/track-order', [App\Http\Controllers\OrderController::class, 'trackOrder'])->name('track.order');
Route::post('/pages/track-order', [App\Http\Controllers\OrderController::class, 'trackOrderSearch'])->name('track.order.search');

// Track Order Routes
Route::get('/pages/track-order', [App\Http\Controllers\OrderController::class, 'trackOrder'])->name('track.order');
Route::post('/pages/track-order', [App\Http\Controllers\OrderController::class, 'trackOrderSearch'])->name('track.order.search');

// Track Order Routes (fix route names)
Route::get('/pages/track-order', [App\Http\Controllers\OrderController::class, 'trackOrder'])->name('pages.track-order');
Route::post('/pages/track-order', [App\Http\Controllers\OrderController::class, 'trackOrderSearch'])->name('pages.track-order.search');

// Track Order Routes
Route::get('/pages/track-order', [App\Http\Controllers\OrderController::class, 'trackOrder'])->name('pages.track-order');
Route::post('/pages/track-order', [App\Http\Controllers\OrderController::class, 'trackOrderSearch'])->name('pages.track-order.search');

// Review Routes
Route::middleware('auth')->group(function () {
    Route::post('/products/{product}/reviews', [App\Http\Controllers\ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
});

// Guest Password Reset Routes
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

Route::middleware('guest')->group(function () {
    Route::get('forgot-password', function () {
        return view('auth.forgot-password');
    })->name('password.request');
    
    Route::post('forgot-password', function (Request $request) {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink($request->only('email'));

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => 'We have emailed your password reset link!'])
                    : back()->withErrors(['email' => 'We could not find a user with that email address.']);
    })->name('password.email');
    
    Route::get('reset-password/{token}', function (string $token) {
        return view('auth.reset-password', ['token' => $token, 'email' => request('email')]);
    })->name('password.reset');
    
    Route::post('reset-password', function (Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with('status', 'Your password has been reset!')
                    : back()->withErrors(['email' => [__($status)]]);
    })->name('password.update');
});

// Contact form submission
Route::post('/pages/contact', [\App\Http\Controllers\PagesController::class, 'submitContact'])->name('pages.contact.submit');

// AI Assistant
Route::post('/ai-assistant/chat', [App\Http\Controllers\AiAssistantController::class, 'chat']);
Route::post('/ai-assistant/add-to-cart', [App\Http\Controllers\AiAssistantController::class, 'addToCart']);


