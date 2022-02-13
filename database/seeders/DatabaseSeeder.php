<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Prophecy\Call\Call;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(UserSeeder::class);
        $hash=Hash::make('admin123');
        $admin=Hash::make('admin123');
        $user=Hash::make('user1234');
        DB::table('users')->insert([
            ['first_name' => "admin",'email'=>'admin@gmail.com','user_role'=>'admin','phone_number'=>'12345678','photo'=>'team-2.jpg','password'=>''.$hash.''],
            ['first_name' => "user",'email'=>'user@gmail.com','user_role'=>'user','phone_number'=>'12345678','photo'=>'team-2.jpg','password'=>''.$user.''],
            ['first_name' => "user1",'email'=>'user1@gmail.com','user_role'=>'user','phone_number'=>'12345678','photo'=>'team-2.jpg','password'=>''.$user.''],
            ['first_name' => "user2",'email'=>'user2@gmail.com','user_role'=>'user','phone_number'=>'12345678','photo'=>'team-2.jpg','password'=>''.$user.''],
            ['first_name' => "user3",'email'=>'user3@gmail.com','user_role'=>'user','phone_number'=>'12345678','photo'=>'team-2.jpg','password'=>''.$user.''],
            ]);
    }
}
