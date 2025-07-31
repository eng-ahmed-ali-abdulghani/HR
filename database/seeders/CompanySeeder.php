<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyTranslation;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
                ['ar' => 'HIS', 'en' => ' HIS '],
            ['ar' => 'شركة المصدر للتقنية و المعلومات ', 'en' => 'SIT'],
        ];

        foreach ($companies as $index => $names) {
            $company = Company::create();

            CompanyTranslation::create([
                'company_id' => $company->id,
                'locale' => 'ar',
                'name' => $names['ar'],
            ]);

            CompanyTranslation::create([
                'company_id' => $company->id,
                'locale' => 'en',
                'name' => $names['en'],
            ]);
        }

    }
}
