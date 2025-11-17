<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::create([
            'name' => 'علیرضا هادی زاده',
            'email' => 'alireza.hadizadeh25@yahoo.com',
            'phone' => '09228422123',
            'email_verified_at' => null,
            'password' => Hash::make('123456'),
            'avatar' => null,
            'bio' => null,
            'role' => 'admin',
            'is_active' => 1,
            'country' => 'Iran',
            'city' => 'Tehran',
            'website' => 'www.alireza-hadizadeh.ir',
        ]);
    }
}
