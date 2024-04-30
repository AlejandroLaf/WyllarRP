<?php

use App\Models\Hechizo;
use App\Models\Personaje;
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
        Schema::create('hechizos_personaje', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Hechizo::class)->index();
            $table->foreignIdFor(Personaje::class)->index();
            $table->unsignedInteger('nivel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hechizos_personaje');
    }
};
