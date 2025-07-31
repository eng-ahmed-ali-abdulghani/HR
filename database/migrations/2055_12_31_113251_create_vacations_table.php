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

            // تاريخ بدء الإجازة
            $table->dateTime('start_date');

            // تاريخ نهاية الإجازة
            $table->dateTime('end_date');

            // الموظف صاحب الإجازة
            $table->foreignId('employee_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            // نوع الإجازة
            $table->foreignId('type_id')->constrained('types')->cascadeOnUpdate()->cascadeOnDelete();

            // سبب الإجازة
            $table->string('reason')->nullable();

            // الموظف البديل خلال الإجازة
            $table->foreignId('replacement_employee_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            // من قدّم الطلب (HR أو القائد)
            $table->foreignId('submitted_by_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            // ملاحظات إضافية
            $table->text('notes')->nullable();

            // هل تمت الموافقة من القائد؟
            $table->boolean('is_leader_approved')->default(false);

            // حالة الإجازة
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            // من قام بالموافقة على الإجازة (اختياري لحين الموافقة)
            $table->foreignId('approved_by_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();

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
