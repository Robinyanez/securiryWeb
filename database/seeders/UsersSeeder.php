<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;
use Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
            DB::table('users')->truncate();
        DB::statement("SET foreign_key_checks=1");

        $users_all = [];

        $users = User::create([
            'name'          => 'Admin',
            'slug'          => 'admin',
            'is_admin'      => true,
            'cedula'        => '7777777777',
            'phone'         => '0987008611',
            'email'         => 'admin@example.com',
            'password'      => Hash::make('123456789'),
        ]);

        $users_all[] = $users->id;

        $users = User::create([
            'name'          => 'Robinson Yánez',
            'slug'          => 'robinson-yanez',
            'is_admin'      => false,
            'cedula'        => '8888888888',
            'phone'         => '0987787183',
            'email'         => 'robin@example.com',
            'password'      => Hash::make('123456789'),

        ]);

        $users_all[] = $users->id;

        $users = User::create([
            'name'          => 'Andres Núñez',
            'slug'          => 'andres-nunez',
            'is_admin'      => false,
            'cedula'        => '9999999999',
            'phone'         => '0987008611',
            'email'         => 'andres@example.com',
            'password'      => Hash::make('123456789'),
        ]);

        $users_all[] = $users->id;
    }
}
