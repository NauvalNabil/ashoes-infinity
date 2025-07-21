<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class UpdateProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        // Mapping kategori lama ke kategori baru
        $categoryMappings = [
            'running' => 'Running Shoes',
            'casual' => 'Casual Sneakers',
            'basketball' => 'Basketball Shoes',
            'formal' => 'Formal Shoes',
            'boots' => 'Boots',
            'sandals' => 'Sandals',
            'sneakers' => 'Casual Sneakers',
            'sport' => 'Running Shoes',
            'lifestyle' => 'Casual Sneakers'
        ];

        // Ambil semua kategori yang ada
        $categories = Category::all()->keyBy('name');

        // Update produk yang ada
        $products = Product::all();

        foreach ($products as $product) {
            // Jika produk memiliki kategori lama (string)
            if ($product->category && is_string($product->category)) {
                $oldCategory = strtolower($product->category);

                // Cari mapping yang sesuai
                foreach ($categoryMappings as $oldCat => $newCat) {
                    if (str_contains($oldCategory, $oldCat)) {
                        if (isset($categories[$newCat])) {
                            $product->update([
                                'category_id' => $categories[$newCat]->id
                            ]);
                            echo "Updated {$product->name} to category: {$newCat}\n";
                        }
                        break;
                    }
                }
            }

            // Jika tidak ada mapping, set ke kategori default
            if (!$product->category_id) {
                $defaultCategory = $categories->first();
                if ($defaultCategory) {
                    $product->update([
                        'category_id' => $defaultCategory->id
                    ]);
                    echo "Set {$product->name} to default category: {$defaultCategory->name}\n";
                }
            }
        }
    }
}
