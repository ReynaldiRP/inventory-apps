<?php

namespace Database\Factories;

use App\Models\ProductType;
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
            'type_id' => ProductType::inRandomOrder()->first()->id,
            'code' => fake()->unique()->numerify('PRD-####'),
            'name' => fake()->word(),
            'unit' => fake()->randomElement(['piece', 'kg', 'litre', 'box']),
            'price' => fake()->numberBetween(1000, 100000),
            'stock' => fake()->numberBetween(0, 500),
        ];
    }
}
