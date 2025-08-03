<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vacation;
use App\Models\User;
use App\Models\Type;
use Illuminate\Support\Facades\DB;
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
                'is_leader_approved' => $leader_status,
                'leader_approved_id' => $leader_status === 'approved' ? $employees->random()->id : null,

                'is_hr_approved' => $hr_status,
                'hr_approved_id' => $hr_status === 'approved' ? $employees->random()->id : null,

                'is_ceo_approved' => $ceo_status,
                'ceo_approved_id' => $ceo_status === 'approved' ? $employees->random()->id : null,
            ]);
        }
    }
}
