<?php

use App\Models\Clase;
use App\Models\TipoArmadura;
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
        Schema::create('clase_armaduras', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Clase::class)->index();
            $table->foreignIdFor(TipoArmadura::class)->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clase_armaduras');
    }
};
