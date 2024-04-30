<?php

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
        Schema::create('armaduras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->foreignIdFor(TipoArmadura::class)->index();
            $table->unsignedInteger('maxDurabilidad');
            $table->unsignedInteger('durabilidad');
            $table->unsignedInteger('armadura');
            $table->unsignedInteger('armadura_magica');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('armaduras');
    }
};
