<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cart_id' => Cart::select()->get()->random()->id,
            'menu_id' => Menu::select()->get()->random()->id,
            'quantity' => $this->faker->numberBetween(1, 10),
        ];
    }
}
