<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'size',
        'color'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    // Relasi dengan Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi dengan Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Accessor untuk total harga item
    public function getTotalPriceAttribute()
    {
        return $this->getAttribute('quantity') * $this->getAttribute('price');
    }
}
