<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('excuses', function (Blueprint $table) {

            $table->id();

            // تاريخ بدء العذر
            $table->dateTime('start_date');

            // تاريخ نهاية العذر
            $table->dateTime('end_date');

            // الموظف صاحب العذر
            $table->foreignId('employee_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            // نوع العذر (طبي، تأخير، ... إلخ)
            $table->foreignId('type_id')->constrained('types')->cascadeOnUpdate()->cascadeOnDelete();

            // السبب نص حر
            $table->string('reason')->nullable();

            // الشخص الذي قدّم العذر في النظام (HR أو مدير)
            $table->foreignId('submitted_by_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            // ملاحظات توضيحية إن وجدت
            $table->text('notes')->nullable();

            // حالة اعتماد القائد
            $table->boolean('leader_approval_status')->default(false);

            // حالة العذر (مقبول، مرفوض، قيد الانتظار)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // هل العذر بسبب مهمة رسمية؟
            $table->boolean('is_due_to_official_mission')->default(false);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('excuses');
    }
};
