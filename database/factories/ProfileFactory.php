<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            // 'address' => $this->faker->address,
            'user_id' => $this->faker->numberBetween(1, 10),
            'account_number' => $this->faker->numberBetween(1000, 2000),
            // 'type' => $this->faker->randomElement(['fastfood', 'sonati']),
        ];
    }
}
