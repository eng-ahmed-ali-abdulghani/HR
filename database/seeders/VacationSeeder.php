<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vacation;
use App\Models\User;
use App\Models\Type;
use Carbon\Carbon;

class VacationSeeder extends Seeder
{
    public function run()
    {
        $employees = User::all();
        $types = Type::all();

        foreach (range(1, 10) as $i) {
            $employee = $employees->random();
            $replacement = $employees->where('id', '!=', $employee->id)->random();
            $submitted_by = $employees->random();

            // موافقات عشوائية
            $leader_status = collect(['pending', 'approved', 'rejected'])->random();
            $hr_status = collect(['pending', 'approved', 'rejected'])->random();
            $ceo_status = collect(['pending', 'approved', 'rejected'])->random();

            $start = Carbon::now()->addDays(rand(1, 30));
            $end = (clone $start)->addDays(rand(1, 7));

            Vacation::create([
                'start_date' => $start,
                'end_date' => $end,
                'employee_id' => $employee->id,
                'type_id' => $types->random()->id,
                'reason' => 'سبب الإجازة رقم ' . $i,
                'replacement_employee_id' => $replacement->id,
                'submitted_by_id' => $submitted_by->id,
                'notes' => 'ملاحظات للإجازة رقم ' . $i,

                'leader_status' => $leader_status,
                'leader_id' => in_array($leader_status, ['approved', 'rejected']) ? $employees->random()->id : null,

                'hr_status' => $hr_status,
                'hr_id' => in_array($hr_status, ['approved', 'rejected']) ? $employees->random()->id : null,

                'ceo_status' => $ceo_status,
                'ceo_id' => in_array($ceo_status, ['approved', 'rejected']) ? $employees->random()->id : null,
            ]);
        }
    }
}
