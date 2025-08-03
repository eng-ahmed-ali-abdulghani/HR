<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $employees = \App\Models\User::pluck('id')->toArray();


        foreach ($employees as $employeeId) {
            // عدد أيام الحضور لكل موظف
            for ($i = 0; $i < 100; $i++) {
                $day = Carbon::now()->subDays($i);

                // دخول الساعة 9:00
                DB::table('attendances')->insert([
                    'employee_id' => $employeeId,
                    'timestamp' => $day->copy()->setTime(9, rand(0, 15)),
                    'type' => 'checkin',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // خروج الساعة 17:00
                DB::table('attendances')->insert([
                    'employee_id' => $employeeId,
                    'timestamp' => $day->copy()->setTime(17, rand(0, 15)),
                    'type' => 'checkout',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

    }
}
