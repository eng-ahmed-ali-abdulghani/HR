<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'test',
            'username' => 'test',
            'code' => '123',
            'phone' => '123456789',
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'qutp',
            'username' => 'qutp',
            'code' => '111',
            'phone' => '111111111',
            'password' => Hash::make('123'),
        ]);
        User::create([
            'name' => 'may',
            'username' => 'may',
            'code' => '000',
            'phone' => '000000000',
            'password' => Hash::make('123'),
            'user_type' => 'admin',
        ]);
    }
}
