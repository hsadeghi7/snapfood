<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
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
            'ingredients' => $this->faker->text,
            'foodCategory' => Category::select('name')->where('type', 'food')->get()->random()->name,
            'image' => $this->faker->imageUrl,
            'user_id' => User::select('id')->get()->random()->id,
        ];
    }
}
