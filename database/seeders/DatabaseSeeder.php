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
            'name' => 'Test User',
            'email' => 'hassan@gmail.com',
            'password'=>bcrypt('Aa123456'),
            'role' => 'admin',
            'is_admin'=>true
        ]);
        \App\Models\User::factory(10)->create();

        

    }
}
