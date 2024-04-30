<?php

use App\Models\Clase;
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
        Schema::create('tabla_clase', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Clase::class)->index();
            $table->unsignedInteger('nivel');
            $table->unsignedInteger('stats');
            $table->unsignedInteger('ph');
            $table->unsignedInteger('exp');
            $table->unsignedInteger('rasgos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_clase');
    }
};
