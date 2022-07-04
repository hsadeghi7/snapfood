<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Coupon;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'hassan@gmail.com',
            'password' => bcrypt('Aa123456'),

        ])
        ->assignRole('superAdmin')
        ->assignRole('admin');

        Coupon::factory(10)->create();
        Category::factory(10)->create();

        $users = User::factory(10)
            ->hasProfile(1)
            ->hasFoods(5)
            ->hasRestaurants(3)
            ->create();
        foreach ($users as $user) {
            $user->assignRole('seller');
        }
    }
}
