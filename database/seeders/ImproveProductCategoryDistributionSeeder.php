<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ImproveProductCategoryDistributionSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();

        // Distribusi manual produk ke kategori yang sesuai
        $productDistribution = [
            'Nike Air Max 270' => 'Running Shoes',
            'Adidas Ultraboost 22' => 'Running Shoes',
            'New Balance 990v5' => 'Running Shoes',
            'Converse Chuck Taylor All Star' => 'Casual Sneakers',
            'Vans Old Skool' => 'Casual Sneakers',
            'Puma RS-X' => 'Casual Sneakers',
            'Jordan Air Jordan 1 Retro High' => 'Basketball Shoes',
            "Women's Classic Pumps" => 'Formal Shoes',
            'Timberland 6-Inch Premium Boots' => 'Boots',
            'Birkenstock Arizona Sandals' => 'Sandals'
        ];

        foreach ($productDistribution as $productName => $categoryName) {
            $product = Product::where('name', 'like', "%{$productName}%")->first();
            $category = $categories->where('name', $categoryName)->first();

            if ($product && $category) {
                $product->update(['category_id' => $category->getKey()]);
                echo "✅ {$productName} → {$categoryName}\n";
            }
        }

        echo "\n🎉 Product distribution completed!\n";
    }
}
