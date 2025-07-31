<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\DepartmentTranslation;
class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['ar' => 'الموارد البشرية', 'en' => 'Human Resources'],
            ['ar' => 'تكنولوجيا المعلومات', 'en' => 'IT'],
            ['ar' => 'المحاسبة', 'en' => 'Accounting'],
            ['ar' => 'التسويق', 'en' => 'Marketing'],
            ['ar' => 'المبيعات', 'en' => 'Sales'],
        ];

        foreach ($departments as $index => $names) {

            $leaders = User::all();
            $companies = Company::all();

            $department = Department::create([
             'company_id' =>  $companies->random()->id
            ]);

            DepartmentTranslation::create([
                'department_id' => $department->id,
                'locale' => 'ar',
                'name' => $names['ar'],
            ]);

            DepartmentTranslation::create([
                'department_id' => $department->id,
                'locale' => 'en',
                'name' => $names['en'],
            ]);
        }

    }
}
