<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
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
            'phone' => '09121234567',
            'type' => Category::select('name')->where('type', 'restaurant')->get()->random()->name,
            'image' => $this->faker->imageUrl,
            'user_id' => User::select('id')->get()->random()->id,
        ];
    }
}
