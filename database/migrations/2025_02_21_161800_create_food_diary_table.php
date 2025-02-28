<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodDiaryTable extends Migration
{
    public function up()
    {
        Schema::create('food_diary', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('food_id');
            $table->string('day')->nullable();
            $table->integer('quantity')->default(1);
            $table->string('unit')->default('db');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('food_id')
                ->references('id')
                ->on('food')
                ->onDelete('cascade');
        });

    }

    public function down()
    {
        Schema::dropIfExists('food_diary');
    }
}

