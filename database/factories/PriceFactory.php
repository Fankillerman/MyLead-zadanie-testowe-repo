<?php

namespace Database\Factories;

use App\Models\Price;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PriceFactory extends Factory
{
    protected $model = Price::class;

    public function definition()
    {
        return [
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'product_id' => function () {
                return Product::factory()->create()->id;
            },
        ];
    }
}
