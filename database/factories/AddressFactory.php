<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Profile;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'is_default' => $this->faker->boolean,
            'latitude' => $this->faker->numberBetween(38.9072, 39.9072),
            'longitude' => $this->faker->numberBetween(51.89072, 52.89072),
            'addressable_type' => $this->faker->randomElements([Restaurant::class, Profile::class, User::class], 3, true)[0],
            'addressable_id' => $this->faker->numberBetween(1, 10),

        ];
    }
}
