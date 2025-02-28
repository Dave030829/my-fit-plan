<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkoutDaysTable extends Migration
{
    public function up()
    {
        Schema::create('workout_days', function (Blueprint $table) {
            $table->id('workout_id');
            $table->unsignedBigInteger('user_id');
            $table->string('workout_day');
            $table->integer('day_index')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'day_index']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('workout_days');
    }
}
