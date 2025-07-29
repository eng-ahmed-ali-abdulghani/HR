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
            $table->date('date')->nullable();
            $table->double('days',2)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('reason_id')->references('id')->on('reasons')->nullable();
            $table->unsignedBigInteger('reason_id')->nullable();
            $table->foreign('actor_id')->references('id')->on('users')->nullable();
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->text('note')->nullable();
            $table->boolean( 'automatic')->default(false);
            $table->boolean( 'status')->default(false);
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
