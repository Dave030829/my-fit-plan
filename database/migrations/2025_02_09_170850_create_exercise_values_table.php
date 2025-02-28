<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseValuesTable extends Migration
{
    public function up()
    {
        Schema::create('exercise_values', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exercise_id');
            $table->integer('set_number');
            $table->integer('weight')->nullable();
            $table->integer('sets')->nullable();
            $table->integer('done')->nullable();
            $table->timestamps();
            $table->foreign('exercise_id')
                  ->references('exercise_id')->on('exercise_name')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('exercise_values');
    }
}
