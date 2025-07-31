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
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // تأكد من وجود بيانات في الجداول المرتبطة
        $employees = User::all();
        $types = Type::all();


        foreach (range(1, 10) as $i) {
            $employee = $employees->random();
            $replacement = $employees->where('id', '!=', $employee->id)->random();
            $submitted_by = $employees->random();
            $approved_by = rand(0, 1) ? $employees->random()->id : null;

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
                'is_leader_approved' => (bool)rand(0, 1),
                'status' => collect(['pending', 'approved', 'rejected'])->random(),
                'approved_by_id' => $approved_by,
            ]);
        }
    }
}
