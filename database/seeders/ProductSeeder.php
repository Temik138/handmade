<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'Курс по реакту',
                'description' => 'Полный курс по React.js',
                'price' => 800,
                'image' => 'kursreact.webp',
                'images' => json_encode(['kursreact.webp', 'kursreact2.webp']),
                'category' => 'kurs',
                'is_popular' => true
            ],
          
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}