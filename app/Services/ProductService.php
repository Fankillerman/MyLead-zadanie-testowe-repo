<?php

namespace App\Services;

use App\Models\Price;
use App\Models\Product;

class ProductService
{
    public function createProduct($name, $description, $price, $id_category)
    {
        $product = new Product();

        $product->name = $name;
        $product->description = $description;
        $product->id_category = $id_category;
        $product->save();

        foreach ($price as $priceId => $priceValue) {
            $price = new Price();
            $price->create(['price' => $priceValue, 'product_id' => $product->id]);
        }

    }

    public function showProducts($searchTerm = null, $categoryId = null, $sortBy = 'name', $sortOrder = 'asc')
    {
        $products = Product::when($searchTerm, function ($query, $searchTerm) {
            return $query->where('name', 'like', '%' . $searchTerm . '%');
        })
            ->when($categoryId, function ($query, $categoryId) {
                return $query->where('id_category', $categoryId);
            })
            ->orderBy($sortBy, $sortOrder);
        if ($sortBy == 'min_price' || $sortBy == 'name') {
            $products = $products->orderByMinPrice($sortOrder);
        }
        if ($sortBy == 'max_price') {
            $products = $products->orderByMaxPrice($sortOrder);
        }
        return $products->simplePaginate(15);
    }

    public function editProduct($id, $name, $description, $prices, $newPrices, $id_category)
    {
        $product = Product::findOrFail($id);

        $product->update([
            'name' => $name,
            'description' => $description,
            'id_category' => $id_category,
        ]);

        foreach ($prices as $priceId => $priceValue) {
            $price = Price::findOrFail($priceId);
            $price->update(['price' => $priceValue]);
        }
        foreach ($newPrices as $newPrice) {
            if (!empty($newPrice)) {
                $product->prices()->create(['price' => $newPrice]);
            }
        }
        return $product;
    }
}
