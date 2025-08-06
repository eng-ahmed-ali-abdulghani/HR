<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{


    public function run(): void
    {
        // Employee data with names and fingerprint IDs
        $employees = [
            ['name' => 'Shreen Shehata', 'fingerprint_id' => 6],
            ['name' => 'Essam Karam', 'fingerprint_id' => 21],
            ['name' => 'Nevin Sadan', 'fingerprint_id' => 26],
            ['name' => 'Mahraman Ahmed', 'fingerprint_id' => 27],
            ['name' => 'Amany Gamal', 'fingerprint_id' => 28],
            ['name' => 'Mohamed Gamil', 'fingerprint_id' => 29],
            ['name' => 'Hatem Salama', 'fingerprint_id' => 33],
            ['name' => 'Fady Filep', 'fingerprint_id' => 44],
            ['name' => 'Ahmed Ayman', 'fingerprint_id' => 55],
            ['name' => 'Hager Ibrahem', 'fingerprint_id' => 61],
            ['name' => 'Tarek Ali', 'fingerprint_id' => 64],
            ['name' => 'Mahmoud Gamal', 'fingerprint_id' => 70],
            ['name' => 'Marwan Khaled', 'fingerprint_id' => 72],
            ['name' => 'Moustafa Marwan', 'fingerprint_id' => 77],
            ['name' => 'Rawan Hosny', 'fingerprint_id' => 78],
            ['name' => 'Esraa Abdelkaer', 'fingerprint_id' => 81],
            ['name' => 'Abeer Rashad', 'fingerprint_id' => 84],
            ['name' => 'Mohamed Gamal', 'fingerprint_id' => 85],
            ['name' => 'Anas Emad', 'fingerprint_id' => 86],
            ['name' => 'Mai Al-Rabi', 'fingerprint_id' => 87],
            ['name' => 'Karem Elsayed', 'fingerprint_id' => 88],
            ['name' => 'Mohamd Basuny', 'fingerprint_id' => 92],
            ['name' => 'Saly Ahmed', 'fingerprint_id' => 158],
            ['name' => 'Amer Hashima', 'fingerprint_id' => 208],
            ['name' => 'Adel Eissa', 'fingerprint_id' => 209],
            ['name' => 'Mohamed Abdelgany', 'fingerprint_id' => 210],
            ['name' => 'Ahmed Ali', 'fingerprint_id' => 211],
            ['name' => 'Mostafa Ali', 'fingerprint_id' => 212],
            ['name' => 'Hussien Salem', 'fingerprint_id' => 213],
            ['name' => 'Employee 9', 'fingerprint_id' => 214],
            ['name' => 'Employee 10', 'fingerprint_id' => 215],
            ['name' => 'Employee 12', 'fingerprint_id' => 216],
            ['name' => 'Employee 11', 'fingerprint_id' => 217],
            ['name' => 'Employee 13', 'fingerprint_id' => 218],
            ['name' => 'Employee 15', 'fingerprint_id' => 219],
            ['name' => 'Employee 16', 'fingerprint_id' => 220],
            ['name' => 'Employee 17', 'fingerprint_id' => 221],
            ['name' => 'Employee 18', 'fingerprint_id' => 222],
            ['name' => 'Employee 19', 'fingerprint_id' => 223],
            ['name' => 'Employee 20', 'fingerprint_id' => 224],
            ['name' => 'Employee 21', 'fingerprint_id' => 225],
            ['name' => 'Employee 22', 'fingerprint_id' => 226],
            ['name' => 'Ahmed Mahmoud', 'fingerprint_id' => 227],
            ['name' => 'Employee 24', 'fingerprint_id' => 228],
            ['name' => 'Employee 23', 'fingerprint_id' => 229],
            ['name' => 'Employee 25', 'fingerprint_id' => 230],
            ['name' => 'Employee 30', 'fingerprint_id' => 231],
            ['name' => 'Employee 31', 'fingerprint_id' => 232],
            ['name' => 'Employee 32', 'fingerprint_id' => 233],
            ['name' => 'Employee 34', 'fingerprint_id' => 234],
            ['name' => 'Employee 35', 'fingerprint_id' => 235],
            ['name' => 'Employee 36', 'fingerprint_id' => 236],
            ['name' => 'Employee 37', 'fingerprint_id' => 237],
            ['name' => 'Employee 38', 'fingerprint_id' => 238],
            ['name' => 'Employee 39', 'fingerprint_id' => 239],
            ['name' => 'Employee 40', 'fingerprint_id' => 240],
            ['name' => 'Employee 41', 'fingerprint_id' => 241],
            ['name' => 'Employee 42', 'fingerprint_id' => 242],
            ['name' => 'Employee 44B', 'fingerprint_id' => 243],
            ['name' => 'Employee 45', 'fingerprint_id' => 244],
            ['name' => 'Employee 46', 'fingerprint_id' => 245],
            ['name' => 'Employee 13875', 'fingerprint_id' => 246],
            ['name' => 'Employee 47', 'fingerprint_id' => 247],
            ['name' => 'Employee 48', 'fingerprint_id' => 248],
            ['name' => 'Employee 49', 'fingerprint_id' => 249],
            ['name' => 'Employee 50', 'fingerprint_id' => 250],
            ['name' => 'Employee 51', 'fingerprint_id' => 251],
            ['name' => 'Employee 52', 'fingerprint_id' => 252],
            ['name' => 'Employee 53', 'fingerprint_id' => 253],
            ['name' => 'Employee 55B', 'fingerprint_id' => 254],
            ['name' => 'Employee 56', 'fingerprint_id' => 255],
            ['name' => 'Employee 57', 'fingerprint_id' => 256],
            ['name' => 'Employee 59', 'fingerprint_id' => 257],
            ['name' => 'Employee 58', 'fingerprint_id' => 258],
            ['name' => 'Employee 61B', 'fingerprint_id' => 259],
            ['name' => 'Employee 62', 'fingerprint_id' => 260],
            ['name' => 'Employee 64B', 'fingerprint_id' => 261],
            ['name' => 'Employee 65', 'fingerprint_id' => 262],
            ['name' => 'Employee 66', 'fingerprint_id' => 263],
            ['name' => 'Employee 67', 'fingerprint_id' => 264],
            ['name' => 'Employee 68', 'fingerprint_id' => 265],
            ['name' => 'Employee 70B', 'fingerprint_id' => 266],
            ['name' => 'Employee 72B', 'fingerprint_id' => 267],
            ['name' => 'Employee 73', 'fingerprint_id' => 268],
            ['name' => 'Employee 74', 'fingerprint_id' => 269],
            ['name' => 'Employee 75', 'fingerprint_id' => 270],
            ['name' => 'Employee 78B', 'fingerprint_id' => 271],
            ['name' => 'Employee 79', 'fingerprint_id' => 272],
            ['name' => 'Employee 81B', 'fingerprint_id' => 273],
            ['name' => 'Employee 82', 'fingerprint_id' => 274],
            ['name' => 'Employee 88B', 'fingerprint_id' => 275],
            ['name' => 'Employee 89', 'fingerprint_id' => 276],
            ['name' => 'Employee 91', 'fingerprint_id' => 277],
        ];

        foreach ($employees as $i => $employee) {
            User::create([
                'name' => $employee['name'],
                'position' => 'emp' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'email' => 'employee' . ($i + 1) . '@company.com',
                'title' => 'موظف',
                'code' => 'EMP' . str_pad($i + 1, 3, '0', STR_PAD_LEFT),
                'password' => Hash::make('password123'),
                'phone' => '05' . str_pad(rand(100000000, 999999999), 9, '0', STR_PAD_LEFT),
                'gender' => rand(0, 1) ? 'male' : 'female',
                'age' => rand(25, 50),
                'birth_date' => now()->subYears(rand(25, 50))->format('Y-m-d'),
                'allowed_vacation_days' => 21,
                'sallary' => rand(8000, 25000),
                'start_date' => now()->subMonths(rand(1, 24))->format('Y-m-d'),
                'end_date' => null,
                'department_id' => rand(1, 3), // assuming you have 3 departments
                'user_type' => 'employee',
                'fcm_token' => null,
                'fingerprint_employee_id' => $employee['fingerprint_id'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Successfully created ' . count($employees) . ' employees');


    }
}
