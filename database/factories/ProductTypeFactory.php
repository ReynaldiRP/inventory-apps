<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductType>
 */
class ProductTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $productType = ['Cement', 'Bricks', 'Steel', 'Wood', 'Glass', 'Paint', 'Tiles', 'Pipes', 'Wiring', 'Insulation'];

        return [
            'type_code' => 'PT-' . $this->faker->unique()->numerify('###'),
            'type_name' => $this->faker->unique()->randomElement($productType),
        ];
    }
}
