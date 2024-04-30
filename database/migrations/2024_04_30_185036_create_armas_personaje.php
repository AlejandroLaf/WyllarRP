<?php

use App\Models\Arma;
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
        Schema::create('armas_personaje', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Personaje::class)->index();
            $table->foreignIdFor(Arma::class)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armas_personaje');
    }
};
