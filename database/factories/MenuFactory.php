<?php

namespace Database\Factories;

use App\Models\Coupon;
use App\Models\Food;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'coupon'=>Coupon::select()->get()->random()->percentage,
            'food_id'=>Food::select()->get()->random()->id,
            'foodParty'=>$this->faker->boolean,
            'menuable_type'=>Restaurant::class,
            'menuable_id'=>Restaurant::select()->get()->random()->id,

        ];
    }
}
