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
        Schema::create('ranuras_personaje', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedInteger('ranuraMax1');
            $table->unsignedInteger('ranuraMax2');
            $table->unsignedInteger('ranuraMax3');
            $table->unsignedInteger('ranuraMax4');
            $table->unsignedInteger('ranuraMax5');
            $table->unsignedInteger('ranuraActual1');
            $table->unsignedInteger('ranuraActual2');
            $table->unsignedInteger('ranuraActual3');
            $table->unsignedInteger('ranuraActual4');
            $table->unsignedInteger('ranuraActual5');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranuras_personaje');
    }
};
