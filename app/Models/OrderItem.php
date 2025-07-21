<?php

namespace App\Models;

<<<<<<< HEAD
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
<<<<<<< HEAD
        'product_name',
        'product_price',
        'size',
        'quantity',
        'subtotal'
    ];

    protected $casts = [
        'product_price' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

=======
        'quantity',
        'price',
        'size',
        'color'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    // Relasi dengan Order
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

<<<<<<< HEAD
=======
    // Relasi dengan Product
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
<<<<<<< HEAD
=======

    // Accessor untuk total harga item
    public function getTotalPriceAttribute()
    {
        return $this->getAttribute('quantity') * $this->getAttribute('price');
    }
>>>>>>> b195e5b7c5ce37678c7a13831918ad16babe9007
}
