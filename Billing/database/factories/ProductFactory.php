<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 *
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('??????')),
            'product_name' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 100),
            'barcode' => $this->faker->unique()->numerify('##########'),
            'price' => $this->faker->randomFloat(2, 5, 100), // random price between $5 and $100
        ];
    }

}
