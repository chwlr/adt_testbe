<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_category' => Category::factory(),
            'product_name' => fake()->domainName(),
            'description' => fake()->text(),
            'quality' => fake()->numberBetween(1, 99),
            'weight' => fake()->numberBetween(1, 99),
            'price' => fake()->numberBetween(1, 9999),
            'brand' => fake()->company(),
            'ingredients' => fake()->text(),
        ];
    }
}
