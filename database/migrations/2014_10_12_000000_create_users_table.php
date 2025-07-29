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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('title')->nullable();
            $table->string('code')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('gender')->nullable();
            $table->integer('age')->nullable();
            $table->date('birth_date')->nullable();
            $table->double('vacations',2)->default(21);
            $table->double('sallary',2)->default(0);
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->useCurrent()->useCurrentOnUpdate();
            $table->foreign('department_id')->references('id')->on('departments')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('shift_id')->references('id')->on('shifts')->nullable();
            $table->unsignedBigInteger('shift_id')->nullable();
            $table->string('user_type')->default("user");
            $table->string('fcm_token')->nullable();
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
