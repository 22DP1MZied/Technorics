<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'discount_price',
        'stock',
        'category_id',
        'brand',
        'image_url',
        'is_active',
        'is_featured',
        'specifications',
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get related products from the same category
     */
    public function getRelatedProducts($limit = 4)
    {
        return Product::where('category_id', $this->category_id)
            ->where('id', '!=', $this->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->limit($limit)
            ->get();
    }

    /**
     * Get products frequently bought together
     * Based on orders that contain this product
     */
    public function getFrequentlyBoughtTogether($limit = 4)
    {
        // Get order IDs that contain this product
        $orderIds = OrderItem::where('product_id', $this->id)
            ->pluck('order_id')
            ->unique();

        if ($orderIds->isEmpty()) {
            // Fallback to related products if no order history
            return $this->getRelatedProducts($limit);
        }

        // Get other products from those orders
        return Product::whereIn('id', function($query) use ($orderIds) {
                $query->select('product_id')
                    ->from('order_items')
                    ->whereIn('order_id', $orderIds)
                    ->where('product_id', '!=', $this->id);
            })
            ->where('is_active', true)
            ->withCount(['orderItems' => function($query) use ($orderIds) {
                $query->whereIn('order_id', $orderIds);
            }])
            ->orderBy('order_items_count', 'desc')
            ->limit($limit)
            ->get();
    }
}
