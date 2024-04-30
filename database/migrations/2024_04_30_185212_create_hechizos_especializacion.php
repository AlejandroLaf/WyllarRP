<?php

use App\Models\Especializacion;
use App\Models\Hechizo;
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
        Schema::create('hechizos_especializacion', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Hechizo::class)->index();
            $table->foreignIdFor(Especializacion::class)->index();
            $table->unsignedInteger('nivel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hechizos_especializacion');
    }
};
