<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' => $this->faker->randomNumber(),
            'uom' => $this->faker->sentence,
            'quantity' => $this->faker->randomNumber(),
            'name' => $this->faker->name
        ];
    }
}
