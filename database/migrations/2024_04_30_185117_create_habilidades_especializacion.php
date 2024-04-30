<?php

use App\Models\Especializacion;
use App\Models\Habilidad;
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
        Schema::create('habilidades_especializacion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Habilidad::class)->index();
            $table->foreignIdFor(Especializacion::class)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habilidades_especializacion');
    }
};
