<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthUserSeeder extends Seeder
{
    public function run()
    {
        // Create an admin user
        // User::create([
        //     'name' => 'Admin User',
        //     'email' => 'admin@example.com',
        //     'password' => Hash::make('password'),
        // ])->assignRole('admin');

        // // Create a regular user
        // User::create([
        //     'name' => 'Regular User',
        //     'email' => 'user@example.com',
        //     'password' => Hash::make('password'),
        // ])->assignRole('user');
    }
}
