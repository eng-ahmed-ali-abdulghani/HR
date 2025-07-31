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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // بيانات المستخدم الأساسية
            $table->string('name');
            $table->string('username')->nullable()->unique();
            $table->string('email')->nullable()->unique();
            $table->string('title')->nullable();
            $table->string('code')->unique(); // كود الموظف
            $table->string('password');
            $table->string('phone')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->date('birth_date')->nullable();

            // بيانات العمل
            $table->decimal('allowed_vacation_days', 5, 2)->default(21); // عدد أيام الإجازة
            $table->decimal('sallary', 10, 2)->default(0);   // الراتب
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            // العلاقات
            $table->foreignId('department_id')->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->integer('fingerprint_employee_id')->index()->nullable();

            // النوع (موظف، مدير، مسؤول...)
            $table->string('user_type')->default('employee');

            // للتنبيهات (FCM)
            $table->string('fcm_token')->nullable();

            // Laravel built-ins
            $table->rememberToken();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
