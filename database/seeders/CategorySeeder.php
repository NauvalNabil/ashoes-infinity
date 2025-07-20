<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Running Shoes',
                'description' => 'High-performance running shoes for athletes and fitness enthusiasts.',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Casual Sneakers',
                'description' => 'Comfortable and stylish sneakers for everyday wear.',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Basketball Shoes',
                'description' => 'Professional basketball shoes with superior grip and support.',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Formal Shoes',
                'description' => 'Elegant formal shoes for business and special occasions.',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Boots',
                'description' => 'Durable boots for outdoor activities and harsh weather.',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Sandals',
                'description' => 'Comfortable sandals for summer and casual occasions.',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
