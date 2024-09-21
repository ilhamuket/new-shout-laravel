<?php

namespace Modules\Auth\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthUserSeeder extends Seeder
{
    public function run()
    {

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'phone_number' => '6289656723',
                'address' => 'Bandung',
                'status' => 'active',
                'password' => Hash::make('password'),
            ]
        )->assignRole('admin');


        User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'Regular User',
                'phone_number' => '6289656723',
                'address' => 'Bandung',
                'status' => 'active',
                'password' => Hash::make('password'),
            ]
        )->assignRole('user');
    }
}
