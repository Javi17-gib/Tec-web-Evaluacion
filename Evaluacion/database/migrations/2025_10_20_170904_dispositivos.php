<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dispositivos', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo', ['tablet', 'telefono', 'otro']);
            $table->string('serial')->unique();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('imei', 50)->nullable();
            $table->date('fecha_compra')->nullable();
            $table->enum('estado', ['disponible','asignado','en_reparacion','danado','perdido'])->default('disponible');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dispositivos');
    }
};
