<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'size',
        'color'
    ];

    // Relasi dengan User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor untuk total harga item
    public function getTotalPriceAttribute()
    {
        return $this->quantity * $this->product->price;
    }

    // Scope untuk cart user tertentu
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}
