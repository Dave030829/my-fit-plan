<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('challenge_user', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                ->references('user_id')->on('users')
                ->onDelete('cascade');

            $table->unsignedBigInteger('challenge_id');
            $table->foreign('challenge_id')
                ->references('id')->on('challenges')
                ->onDelete('cascade');

            $table->integer('days_completed')->default(0);
            $table->date('last_completed_date')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('challenge_user');
    }

};
