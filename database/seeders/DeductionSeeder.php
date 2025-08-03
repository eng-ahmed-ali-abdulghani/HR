<?php

namespace Database\Seeders;

use App\Models\Deduction;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */


    public function run(): void
    {
        $employees = User::pluck('id');
        $approvers = User::pluck('id');
        $types = Type::pluck('id');

        for ($i = 0; $i < 50; $i++) {
            $isAuto = rand(0, 1) === 1;

            $isLeader = collect(['pending', 'approved', 'rejected'])->random();
            $isHr = $isLeader === 'approved' ? collect(['pending', 'approved', 'rejected'])->random() : 'pending';
            $isCeo = ($isLeader === 'approved' && $isHr === 'approved') ? collect(['pending', 'approved', 'rejected'])->random() : 'pending';

            Deduction::create([
                'deduction_days' => rand(1, 10) / 2, // مثال: 0.5, 1.0, 1.5, ... 5.0
                'employee_id' => $employees->random(),
                'type_id' => $types->random(),
                'reason' => fake()->sentence(),
                'submitted_by_id' => $isAuto ? null : $approvers->random(),
                'notes' => fake()->boolean(50) ? fake()->sentence() : null,
                'is_automatic' => $isAuto,

                'is_leader_approved' => $isLeader,
                'leader_approved_id' => $isLeader !== 'pending' ? $approvers->random() : null,

                'is_hr_approved' => $isHr,
                'hr_approved_id' => $isHr !== 'pending' ? $approvers->random() : null,

                'is_ceo_approved' => $isCeo,
                'ceo_approved_id' => $isCeo !== 'pending' ? $approvers->random() : null,
            ]);
        }
    }


}
