<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // تجاهل أول صف لو فيه رؤوس أعمدة

            // مثال على استخراج بيانات
            $name = $row[0];
            $email = $row[1];

            // مثال: حفظ مستخدم
            // User::create(['name' => $name, 'email' => $email]);
        }
    }
}
