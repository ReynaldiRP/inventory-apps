<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Receipt>
 */
class ReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'receipt_number' => fake()->unique()->numerify('RCT-####'),
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => fake()->numberBetween(1, 10),
            'price' => $product->price,
            'type' => fake()->randomElement(['in', 'out']),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
