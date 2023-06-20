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
        Schema::create('workouts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('reps')->nullable();
            $table->string('weight')->nullable();
            $table->string('time')->nullable();
            $table->string('distance')->nullable();

            $table->foreignId('coach_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('client_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('exercise_id')
                ->constrained('exercises')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('appointment_id')
                ->constrained('appointments')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('workouts', function (Blueprint $table) {
            $table->dropConstrainedForeignId('coach_id');
            $table->dropConstrainedForeignId('client_id');
            $table->dropConstrainedForeignId('exercise_id');
            $table->dropConstrainedForeignId('appointment_id');
        });

        Schema::dropIfExists('workouts');

    }
};
