<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function prices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Price::class);
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Category::class, 'id', 'id_category');
    }

    public function scopeOrderByMinPrice($query)
    {
        return $query->leftJoin('prices', 'products.id', '=', 'prices.product_id')
            ->select('products.*', \DB::raw('MIN(prices.price) as min_price'))
            ->groupBy('products.id')
            ->orderBy('min_price');
    }

    public function scopeOrderByMaxPrice($query)
    {
        return $query->leftJoin('prices', 'products.id', '=', 'prices.product_id')
            ->select('products.*', \DB::raw('MAX(prices.price) as max_price'))
            ->groupBy('products.id')
            ->orderBy('max_price');
    }
}
