<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::create([
            'first_name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345'),
            'user_role' => 'admin',
        ]);
    }
}
