<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = Category::all();
        $products = [];

        // создаем 10 продуктов
        for ($i = 0; $i < 10; $i++) {
            $category = $categories->random(); // случайная категория из списка
            $product = Product::factory()->create([
                'id_category' => $category->id, // присваиваем категорию продукту
            ]);

            // добавляем продукт в список продуктов
            $products[] = $product;
        }

        // добавляем три цены для каждого продукта
        foreach ($products as $product) {
            Price::factory()->count(3)->create([
                'product_id' => $product->id,
            ]);
        }
    }
}
