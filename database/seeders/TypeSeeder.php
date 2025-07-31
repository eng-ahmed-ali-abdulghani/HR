<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            // Vacation types
            ['vacation', 'Annual Leave', 'إجازة سنوية'],
            ['vacation', 'Sick Leave', 'إجازة مرضية'],
            ['vacation', 'Hajj Leave', 'إجازة حج'],
            ['vacation', 'Unpaid Leave', 'إجازة بدون راتب'],

            // Excuse types
            ['excuse', 'Late Arrival', 'تأخير في الحضور'],
            ['excuse', 'Early Leave', 'خروج مبكر'],
            ['excuse', 'Doctor Appointment', 'موعد طبيب'],
            ['excuse', 'Personal Reason', 'سبب شخصي'],

            // Deduction types
            ['deductions', 'Absence Deduction', 'خصم بسبب غياب'],
            ['deductions', 'Penalty Deduction', 'خصم بسبب مخالفة'],
        ];
        foreach ($types as [$typeValue, $nameEn, $nameAr]) {
            $type = Type::create([
                'type' => $typeValue,
            ]);

            DB::table('type_translations')->insert([
                [
                    'type_id' => $type->id,
                    'locale' => 'en',
                    'name' => $nameEn,
                ],
                [
                    'type_id' => $type->id,
                    'locale' => 'ar',
                    'name' => $nameAr,
                ],
            ]);
        }
    }
}
