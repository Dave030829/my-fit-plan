<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('kcal');
            $table->float('protein');
            $table->float('fat');
            $table->float('carbs');
            $table->integer('quantity')->default(1);
            $table->string('unit')->default('db');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
