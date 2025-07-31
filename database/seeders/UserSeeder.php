<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

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

        $names = [
            'Marwan Khaled',
            'Moustafa Marwan',
            'Rawan Hosny',
            'Esraa Abdelkaer',
            'Abeer Rashad',
            'Mohamed Gamal',
            'Anas Emad',
            'Mai Al-Rabi',
            'Karem Elsayed',
            'Mohamd Basuny',
            'Saly Ahmed',
            'Amer Hashima',
            'Adel Eissa',
            'Mohamed Abdelgany',
            'Ahmed Ali',
            'Mostafa Ali',
            'Hussien Salem',
        ];

        foreach ($names as $i => $name) {
            User::create([
                'name' => $name,
                'username' => 'user' . ($i + 1),
                'email' => 'user' . ($i + 1) . '@example.com',
                'title' => 'موظف',
                'code' => 'EMP' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'password' => Hash::make('password'),
                'phone' => '05' . rand(100000000, 999999999),
                'gender' => rand(0, 1) ? 'male' : 'female',
                'age' => rand(22, 45),
                'birth_date' => now()->subYears(rand(22, 45))->format('Y-m-d'),
                'allowed_vacation_days' => 21,
                'sallary' => rand(8000, 20000),
                'start_date' => now()->subMonths(rand(1, 12))->format('Y-m-d'),
                'end_date' => null,
                'department_id' => 1,
                'user_type' => 'employee',
                'fcm_token' => null,
            ]);
        }
    }
}
