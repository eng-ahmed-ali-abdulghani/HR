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

        $faker = Faker::create('ar_EG'); // أو 'en_US' حسب اللغة

        for ($i = 1; $i <= 25; $i++) {
            User::create([
                'name' => $faker->name,
                'username' => 'user' . $i,
                'email' => 'user' . $i . '@example.com',
                'title' => $faker->jobTitle,
                'code' => 'EMP' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'password' => Hash::make('password'), // كلهم كلمة سرهم "password"
                'phone' => '05' . rand(000000000, 999999999),
                'gender' => $faker->randomElement(['male', 'female']),
                'age' => rand(22, 45),
                'birth_date' => $faker->date('Y-m-d', '2002-01-01'),
                'allowed_vacation_days' => 21,
                'sallary' => rand(8000, 20000),
                'start_date' => $faker->date('Y-m-d', '2024-01-01'),
                'end_date' => null,
                'department_id' => 1, // تأكد أن القسم موجود
                'user_type' => $faker->randomElement(['employee', 'hr']),
                'fcm_token' => null,
            ]);
        }
    }
}
