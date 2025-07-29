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
        Schema::create('excuses', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->double('hours',2)->nullable();
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types')->nullable();
            $table->unsignedBigInteger('type_id')->nullable();
            $table->foreign('reason_id')->references('id')->on('reasons')->nullable();
            $table->unsignedBigInteger('reason_id')->nullable();
            $table->foreign('actor_id')->references('id')->on('users')->nullable();
            $table->unsignedBigInteger('actor_id')->nullable();
            $table->text('note')->nullable();
            $table->boolean( 'leader_approve')->default(false);
            $table->foreign('statu_id')->references('id')->on('status')->nullable();
            $table->unsignedBigInteger('statu_id')->nullable();
            $table->boolean( 'mission')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excuses');
    }
};
