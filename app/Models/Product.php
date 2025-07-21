<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'brand',
        'color',
        'sizes',
        'image',
        'gallery',
        'is_active'
    ];

    protected $casts = [
        'sizes' => 'array',
        'gallery' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2'
    ];

<<<<<<< HEAD
    /**
     * Relationship with Cart
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Relationship with OrderItems
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get formatted price
     */
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Get main image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    /**
     * Get gallery URLs
     */
    public function getGalleryUrlsAttribute()
    {
        return $this->gallery ? array_map(function($img) {
            return asset('storage/' . $img);
        }, $this->gallery) : [];
    }

    /**
     * Check if product is in stock
     */
    public function isInStock($quantity = 1)
    {
        return $this->stock >= $quantity;
    }

    /**
     * Check if size is available
     */
    public function hasSizeAvailable($size)
    {
        return in_array($size, $this->sizes ?? []);
=======
    // Relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope untuk produk aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk produk dengan stok rendah
    public function scopeLowStock($query, $threshold = 10)
    {
        return $query->where('stock', '<=', $threshold)->where('stock', '>', 0);
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007
    }
}
