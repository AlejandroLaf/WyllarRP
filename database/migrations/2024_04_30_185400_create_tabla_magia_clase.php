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
        Schema::create('tabla_magia_clase', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Clase::class)->index();
            $table->unsignedInteger('ranuras1');
            $table->unsignedInteger('ranuras2');
            $table->unsignedInteger('ranuras3');
            $table->unsignedInteger('ranuras4');
            $table->unsignedInteger('ranuras5');
            $table->unsignedInteger('hechizos1');
            $table->unsignedInteger('hechizos2');
            $table->unsignedInteger('hechizos3');
            $table->unsignedInteger('hechizos4');
            $table->unsignedInteger('hechizos5');
            $table->unsignedInteger('nivel');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tabla_magia_clase');
    }
};
