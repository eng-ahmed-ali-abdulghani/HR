<?php

namespace Database\Seeders;

use App\Models\Deduction;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DeductionSeeder extends Seeder
{
    public function run(): void
    {
        $employees = User::pluck('id');
        $approvers = User::pluck('id');
        $types = Type::pluck('id');

        for ($i = 0; $i < 50; $i++) {
            $isAuto = rand(0, 1) === 1;

            $leader_status = collect(['pending', 'approved', 'rejected'])->random();
            $hr_status = $leader_status === 'approved' ? collect(['pending', 'approved', 'rejected'])->random() : 'pending';
            $ceo_status = ($leader_status === 'approved' && $hr_status === 'approved') ? collect(['pending', 'approved', 'rejected'])->random() : 'pending';

            Deduction::create([
                'deduction_days' => rand(1, 10) / 2,
                'employee_id' => $employees->random(),
                'type_id' => $types->random(),
                'reason' => fake()->sentence(),
                'submitted_by_id' => $isAuto ? null : $approvers->random(),
                'notes' => fake()->boolean(50) ? fake()->sentence() : null,
                'is_automatic' => $isAuto,

                'leader_status' => $leader_status,
                'leader_id' => in_array($leader_status, ['approved', 'rejected']) ? $approvers->random() : null,

                'hr_status' => $hr_status,
                'hr_id' => in_array($hr_status, ['approved', 'rejected']) ? $approvers->random() : null,

                'ceo_status' => $ceo_status,
                'ceo_id' => in_array($ceo_status, ['approved', 'rejected']) ? $approvers->random() : null,
            ]);
        }
    }
}
