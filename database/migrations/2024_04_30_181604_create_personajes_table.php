<?php

use App\Models\Clase;
use App\Models\Especializacion;
use App\Models\User;
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
        Schema::create('personajes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->unsignedInteger('FUE')->default(14);
            $table->unsignedInteger('DES')->default(14);
            $table->unsignedInteger('CON')->default(14);
            $table->unsignedInteger('PER')->default(14);
            $table->unsignedInteger('SAB')->default(14);
            $table->unsignedInteger('CAR')->default(14);
            $table->unsignedInteger('VOL')->default(14);
            $table->unsignedInteger('VIT')->default(3);
            $table->unsignedInteger('nivel')->default(1);
            $table->unsignedInteger('defensa')->default(3);
            $table->unsignedInteger('armadura')->default(0);
            $table->unsignedInteger('armadura_magica')->default(1);
            $table->unsignedInteger('HP')->default(8);
            $table->unsignedInteger('PH')->default(1);
            $table->unsignedInteger('EXP')->default(0);
            $table->foreignIdFor(User::class)->index();
            $table->foreignIdFor(Clase::class)->index();
            $table->foreignIdFor(Especializacion::class)->index()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personajes');
    }
};
