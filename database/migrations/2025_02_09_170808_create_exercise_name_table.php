<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseNameTable extends Migration
{
    public function up()
    {
        Schema::create('exercise_name', function (Blueprint $table) {
            $table->id('exercise_id');
            $table->string('exercise_name', 255);
            $table->unsignedBigInteger('workout_id');
            $table->integer('exercise_index')->nullable();
            $table->timestamps();
            $table->foreign('workout_id')
                  ->references('workout_id')->on('workout_days')
                  ->onDelete('cascade');
                        $table->unique(['workout_id', 'exercise_index']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('exercise_name');
    }
}
