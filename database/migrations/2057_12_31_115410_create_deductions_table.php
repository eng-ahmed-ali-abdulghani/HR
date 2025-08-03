<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('deductions', function (Blueprint $table) {
            $table->id();

            // عدد أيام الخصم
            $table->decimal('deduction_days', 4, 2)->nullable();

            // الموظف المتأثر بالخصم
            $table->foreignId('employee_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            // نوع الخصم
            $table->foreignId('type_id')->constrained('types')->cascadeOnUpdate()->cascadeOnDelete();

            // سبب الخصم (نص حر)
            $table->string('reason')->nullable();

            // من قام بالخصم (HR أو النظام)
            $table->foreignId('submitted_by_id')->nullable()->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();

            // ملاحظات إضافية
            $table->text('notes')->nullable();

            // هل تم الخصم تلقائيًا؟
            $table->boolean('is_automatic')->default(false);

            // الموافقات
            $table->enum('is_leader_approved', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('leader_approved_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();

            $table->enum('is_hr_approved', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('hr_approved_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();

            $table->enum('is_ceo_approved', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('ceo_approved_id')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deductions');
    }
};
