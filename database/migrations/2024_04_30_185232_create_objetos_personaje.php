<?php

use App\Models\Objeto;
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
        Schema::create('objetos_personaje', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Objeto::class)->index();
            $table->foreignIdFor(Personaje::class)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objetos_personaje');
    }
};
