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
            'name'          => 'SuperAdmin',
            'slug'          => 'superadmin',
            'role'          => 'SuperAdmin',
            'puesto'        => 'SuperAdmin',
            'cedula'        => '0503246407',
            'phone'         => '0987787183',
            'email'         => 'superadmin@example.com',
            'password'      => Hash::make('123456789'),
        ]);

        $users_all[] = $users->id;

        $users = User::create([
            'name'          => 'Admin',
            'slug'          => 'admin',
            'role'          => 'Admin',
            'puesto'        => 'Admin',
            'cedula'        => '0503246381',
            'phone'         => '0987008611',
            'email'         => 'admin@example.com',
            'password'      => Hash::make('123456789'),
        ]);

        $users_all[] = $users->id;

        $users = User::create([
            'name'          => 'Robinson Yánez',
            'slug'          => 'robinson-yanez',
            'role'          => 'Supervisor',
            'puesto'        => 'Supervisor',
            'cedula'        => '0503246407',
            'phone'         => '0987787183',
            'email'         => 'robin@example.com',
            'password'      => Hash::make('123456789'),
        ]);

        $users_all[] = $users->id;

        $users = User::create([
            'name'          => 'Andres Núñez',
            'slug'          => 'andres-nunez',
            'role'          => 'Vigilante',
            'puesto'        => 'Vigilante',
            'cedula'        => '0503246381',
            'phone'         => '0987008611',
            'email'         => 'andres@example.com',
            'password'      => Hash::make('123456789'),
        ]);

        $users_all[] = $users->id;
    }
}
