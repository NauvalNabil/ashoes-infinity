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
        'category',
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
}
