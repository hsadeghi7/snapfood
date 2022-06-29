<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'hassan@gmail.com',
            'password'=>bcrypt('Aa123456'),
            'role' => 'superAdmin',
            'is_admin'=>true
        ]);    
        \App\Models\Coupon::factory(10)->create();
        \App\Models\Category::factory(10)->create();        
        \App\Models\Restaurant::factory(3)->create();        

        \App\Models\User::factory()->count(10)->hasProfiles(1)->hasFoods(5)->create();

    }
}
