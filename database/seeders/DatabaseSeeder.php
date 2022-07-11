<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Menu;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Address;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(RoleSeeder::class);
        Coupon::factory(10)->create();
        Category::factory(10)->create();


        User::factory()->create([
            'name' => 'Admin',
            'email' => 'hassan@gmail.com',
            'password' => Hash::make('Aa123456'),

        ])
            ->assignRole('superAdmin')
            ->assignRole('admin');

        User::factory()->create([
            'name' => 'Buyer',
            'email' => 'buyer@gmail.com',
            'password' => Hash::make('password'),

        ])
            ->assignRole('buyer');

        //seller seeder
        $users = User::factory(10)
            ->hasProfile(1)
            ->hasFoods(5)
            ->hasRestaurants(3)
            ->hasAddresses(1)
            ->create();
        foreach ($users as $user) {
            $user->assignRole('seller');
        }

        $users->each(function ($user) {
            $user->restaurants()->each(function ($restaurant) {
                $restaurant->menus()->saveMany(
                    Menu::factory(4)->create(
                        [
                            'coupon' => Coupon::select()->get()->random()->percentage,
                            'food_id' => $restaurant->user->foods()->get()->random()->id,
                            'foodParty' => false,
                            'menuable_type' => Restaurant::class,
                            'menuable_id' => $restaurant->user->restaurants()->get()->random()->id,

                        ],

                    )
                );
            });
        });

        $users->each(function ($user) {
            $user->restaurants()->each(function ($restaurant) {
                $restaurant->Addresses()->saveMany(Address::factory(1)->create());
            });
        });

        $users->each(function ($user) {
            $user->profile()->each(function ($profile) {
                $profile->Addresses()->saveMany(Address::factory(1)->create());
            });
        });

        //Buyer Seeder
        $users = User::factory(10)
            ->hasAddresses(1)
            ->hasCarts(1)
            ->create();

        foreach ($users as $user) {
            $user->assignRole('buyer');
        }

        $users->each(function ($user) {
            $user->carts->each(function ($cart) {
                $cart->cartItems()->saveMany(CartItem::factory(3)->create());
            });
        });
    }
}
