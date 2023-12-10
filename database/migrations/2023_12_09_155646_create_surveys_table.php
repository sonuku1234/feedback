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
        Schema::create('surveys', function (Blueprint $table) {


            $table->id();
            $table->integer('coordinator_id');
            $table->string('name');
            $table->text('questions');
            $table->integer('min_age')->nullable();
            $table->integer('max_age')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();

            $table->timestamp('start_time');
            $table->timestamp('end_time')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surveys');
    }
};
