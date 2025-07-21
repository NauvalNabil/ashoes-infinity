<?php

namespace Database\Seeders;

use App\Models\HeroContent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroContents = [
            [
                'title' => 'Step Into Style with AShoes Infinity',
                'subtitle' => 'Premium Quality Footwear Collection',
                'description' => 'Discover our exclusive range of shoes that combines comfort, style, and durability. From sports sneakers to elegant dress shoes, find your perfect pair today.',
                'button_text' => 'Shop Now',
                'button_url' => '#products',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Limited Edition Releases',
                'subtitle' => 'Exclusive Designs Available Now',
                'description' => 'Get your hands on our limited edition shoes featuring unique designs and premium materials. Limited quantities available.',
                'button_text' => 'View Collection',
                'button_url' => '#limited',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Summer Sale - Up to 50% Off',
                'subtitle' => 'Hot Deals on Your Favorite Brands',
                'description' => 'Beat the heat with our summer sale! Enjoy massive discounts on selected shoes from top brands.',
                'button_text' => 'Shop Sale',
                'button_url' => '#sale',
                'is_active' => true,
                'sort_order' => 3,
            ]
        ];

        foreach ($heroContents as $content) {
            HeroContent::create($content);
        }
    }
}
