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
            ['ar' => 'الموارد البشرية', 'en' => 'HR'],
            ['ar' => 'تكنولوجيا المعلومات', 'en' => 'IT'],
            ['ar' => 'المحاسبة', 'en' => 'Accounting'],
            ['ar' => 'التسويق', 'en' => 'Marketing'],
            ['ar' => 'المبيعات', 'en' => 'Sales'],

            // من الصورة:
            ['ar' => 'الرئيس التنفيذي', 'en' => 'CEO'],
            ['ar' => 'المدير الإقليمي', 'en' => 'Regional Director'],
            ['ar' => 'مسؤول قواعد البيانات', 'en' => 'DBA'],
            ['ar' => 'مسؤول الشبكة', 'en' => 'Network Administrator'],
            ['ar' => 'مطور PHP Laravel', 'en' => 'PHP Laravel'],
            ['ar' => 'الصيانة', 'en' => 'Maintenance'],
            ['ar' => 'مبيعات صالة العرض', 'en' => 'Showroom Sales'],
            ['ar' => 'أوراكل أبيكس', 'en' => 'Oracle Apex'],
            ['ar' => 'الدعم الفني', 'en' => 'Technical Support'],
            ['ar' => 'البوفيه', 'en' => 'Buffet'],
            ['ar' => 'المدير', 'en' => 'Manager'],
            ['ar' => 'مطور أوراكل', 'en' => 'Oracle Developer'],
            ['ar' => 'مهندس ذكاء اصطناعي', 'en' => 'AI Engineer'],
            ['ar' => 'مصمم', 'en' => 'Designer'],
            ['ar' => 'مختبر برامج', 'en' => 'Tester'],
            ['ar' => 'مطور Flutter', 'en' => 'Flutter'],
            ['ar' => 'منشئ محتوى', 'en' => 'Content Creator'],
            ['ar' => 'مطور PHP', 'en' => 'PHP'],
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
