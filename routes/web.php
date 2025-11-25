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
