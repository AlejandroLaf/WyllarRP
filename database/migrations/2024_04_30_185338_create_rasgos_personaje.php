<?php

use App\Models\Personaje;
use App\Models\Rasgo;
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
        Schema::create('rasgos_personaje', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Rasgo::class)->index();
            $table->foreignIdFor(Personaje::class)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rasgos_personaje');
    }
};
