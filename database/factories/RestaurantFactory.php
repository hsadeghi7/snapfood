<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
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
            'phone' => $this->faker->phoneNumber,
            'type' => $this->faker->word,
            'image' => $this->faker->imageUrl,
            'user_id' => $this->faker->numberBetween(1, 10),
        ];
    }
}
