<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(1, 100),
            'coupon' => $this->faker->numberBetween(1, 100),
            'foodParty' => $this->faker->boolean,
            'ingredients' => $this->faker->text,
            'foodCategory' => $this->faker->word,
            'image' => $this->faker->imageUrl,
            'user_id' => $this->faker->numberBetween(1, 10),
            'categoryable_type' => $this->faker->randomElement(['App\Models\Food', 'App\Models\Restaurant']),
            'categoryable_id' => $this->faker->numberBetween(1, 10),
            'is_active' => $this->faker->boolean,

        ];
    }
}
