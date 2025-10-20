<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historial_dispositivo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dispositivo_id')->constrained('dispositivos')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('estado_anterior', ['disponible','asignado','en_reparacion','danado','perdido'])->nullable();
            $table->enum('estado_nuevo', ['disponible','asignado','en_reparacion','danado','perdido']);
            $table->foreignId('cambiado_por')->nullable()->constrained('users')->onUpdate('cascade')->nullOnDelete();
            $table->text('comentario')->nullable();
            $table->dateTime('fecha_cambio')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historial_estado_dispositivos');
    }
};
