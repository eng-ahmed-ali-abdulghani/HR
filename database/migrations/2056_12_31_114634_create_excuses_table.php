<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('excuses', function (Blueprint $table) {
            $table->id();

            // التواريخ
            $table->dateTime('start_date'); // تاريخ بدء العذر
            $table->dateTime('end_date');   // تاريخ نهاية العذر

            // بيانات الموظف
            $table->foreignId('employee_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete(); // الموظف صاحب العذر
            $table->foreignId('replacement_employee_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete(); // الموظف البديل

            // نوع العذر والسبب
            $table->foreignId('type_id')->constrained('types')->cascadeOnUpdate()->cascadeOnDelete(); // نوع العذر
            $table->string('reason')->nullable(); // سبب العذر

            // من قدّم الطلب (HR أو القائد)
            $table->foreignId('submitted_by_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            // ملاحظات إضافية
            $table->text('notes')->nullable();

            // الموافقات
            $table->enum('is_leader_approved', ['pending', 'approved', 'rejected'])->default('pending'); // هل تمت الموافقة من القائد؟
            $table->foreignId('leader_approved_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();

            $table->enum('is_hr_approved', ['pending', 'approved', 'rejected'])->default('pending'); // هل تمت الموافقة من HR؟
            $table->foreignId('hr_approved_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();

            $table->enum('is_ceo_approved', ['pending', 'approved', 'rejected'])->default('pending'); // هل تمت الموافقة من المدير التنفيذي؟
            $table->foreignId('ceo_approved_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();

            $table->timestamps();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('excuses');
    }
};
