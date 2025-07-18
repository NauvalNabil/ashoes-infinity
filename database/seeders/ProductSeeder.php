<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Nike Air Max 270',
                'description' => 'The Nike Air Max 270 delivers unparalleled comfort and a striking visual experience.',
                'price' => 150.00,
                'stock' => 25,
                'category' => 'sports',
                'brand' => 'Nike',
                'color' => 'Black/White',
                'sizes' => ['8', '8.5', '9', '9.5', '10', '10.5', '11'],
                'is_active' => true,
            ],
            [
                'name' => 'Adidas Ultraboost 22',
                'description' => 'Feel endless energy when you lace up these adidas Ultraboost 22 running shoes.',
                'price' => 180.00,
                'stock' => 18,
                'category' => 'sports',
                'brand' => 'Adidas',
                'color' => 'Core Black',
                'sizes' => ['7', '7.5', '8', '8.5', '9', '9.5', '10'],
                'is_active' => true,
            ],
            [
                'name' => 'Converse Chuck Taylor All Star',
                'description' => 'The iconic canvas sneaker that started it all.',
                'price' => 55.00,
                'stock' => 30,
                'category' => 'casual',
                'brand' => 'Converse',
                'color' => 'White',
                'sizes' => ['6', '6.5', '7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11'],
                'is_active' => true,
            ],
            [
                'name' => 'Vans Old Skool',
                'description' => 'The classic side-stripe shoe with iconic styling and authentic Vans DNA.',
                'price' => 65.00,
                'stock' => 22,
                'category' => 'casual',
                'brand' => 'Vans',
                'color' => 'Black/White',
                'sizes' => ['7', '7.5', '8', '8.5', '9', '9.5', '10', '10.5'],
                'is_active' => true,
            ],
            [
                'name' => 'Puma RS-X',
                'description' => 'Bold and unapologetic, the RS-X is a statement shoe for those who dare to be different.',
                'price' => 110.00,
                'stock' => 8,
                'category' => 'sports',
                'brand' => 'Puma',
                'color' => 'Multi',
                'sizes' => ['8', '8.5', '9', '9.5', '10'],
                'is_active' => true,
            ],
            [
                'name' => "Women's Classic Pumps",
                'description' => 'Elegant classic pumps perfect for office or formal occasions.',
                'price' => 89.99,
                'stock' => 15,
                'category' => 'formal',
                'brand' => 'Calvin Klein',
                'color' => 'Black',
                'sizes' => ['6', '6.5', '7', '7.5', '8', '8.5', '9'],
                'is_active' => true,
            ],
            [
                'name' => 'Timberland 6-Inch Premium Boots',
                'description' => 'Waterproof nubuck leather boots built for durability and comfort.',
                'price' => 199.99,
                'stock' => 12,
                'category' => 'boots',
                'brand' => 'Timberland',
                'color' => 'Wheat',
                'sizes' => ['8', '8.5', '9', '9.5', '10', '10.5', '11', '11.5'],
                'is_active' => true,
            ],
            [
                'name' => 'Birkenstock Arizona Sandals',
                'description' => 'The classic two-strap design from 1963 that has become a comfortable legend.',
                'price' => 99.99,
                'stock' => 0,
                'category' => 'sandals',
                'brand' => 'Birkenstock',
                'color' => 'Brown',
                'sizes' => ['7', '8', '9', '10', '11'],
                'is_active' => false,
            ],
            [
                'name' => 'Jordan Air Jordan 1 Retro High',
                'description' => 'The sneaker that started it all. Michael Jordan\'s first signature shoe.',
                'price' => 170.00,
                'stock' => 6,
                'category' => 'sports',
                'brand' => 'Jordan',
                'color' => 'Bred',
                'sizes' => ['8', '8.5', '9', '9.5', '10', '10.5'],
                'is_active' => true,
            ],
            [
                'name' => 'New Balance 990v5',
                'description' => 'Made in the USA, this premium running shoe offers superior comfort and stability.',
                'price' => 185.00,
                'stock' => 14,
                'category' => 'sports',
                'brand' => 'New Balance',
                'color' => 'Grey',
                'sizes' => ['7.5', '8', '8.5', '9', '9.5', '10', '10.5', '11'],
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
