<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up(): void
    {
        Schema::create('vacations', function (Blueprint $table) {
            $table->id();

            // التواريخ
            $table->dateTime('start_date'); // تاريخ بدء الإجازة
            $table->dateTime('end_date');   // تاريخ نهاية الإجازة

            // بيانات الموظف
            $table->foreignId('employee_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete(); // الموظف صاحب الإجازة
            $table->foreignId('replacement_employee_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete(); // الموظف البديل

            // نوع الإجازة والسبب
            $table->foreignId('type_id')->constrained('types')->cascadeOnUpdate()->cascadeOnDelete(); // نوع الإجازة
            $table->string('reason')->nullable(); // سبب الإجازة

            // من قدّم الطلب (HR أو القائد)
            $table->foreignId('submitted_by_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            // ملاحظات إضافية
            $table->text('notes')->nullable();

            // الموافقات
            $table->enum('leader_status', ['pending', 'approved', 'rejected'])->default('pending'); // هل تمت الموافقة من القائد؟
            $table->foreignId('leader_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();

            $table->enum('hr_status', ['pending', 'approved', 'rejected'])->default('pending'); // هل تمت الموافقة من HR؟
            $table->foreignId('hr_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();

            $table->enum('ceo_status', ['pending', 'approved', 'rejected'])->default('pending'); // هل تمت الموافقة من المدير التنفيذي؟
            $table->foreignId('ceo_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacations');
    }
};
