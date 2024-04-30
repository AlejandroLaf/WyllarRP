<?php

use App\Models\Habilidad;
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
        Schema::create('habilidades_personaje', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Habilidad::class)->index();
            $table->foreignIdFor(Personaje::class)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habilidades_personaje');
    }
};
