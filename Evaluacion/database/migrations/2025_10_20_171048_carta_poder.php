<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carta_poder', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asignacion_id')->constrained('asignaciones')->onUpdate('cascade')->onDelete('cascade');
            $table->string('ruta_pdf');
            $table->text('contenido')->nullable();
            $table->text('codigo_qr')->nullable();
            $table->foreignId('generado_por')->nullable()->constrained('users')->onUpdate('cascade')->nullOnDelete();
            $table->dateTime('fecha_generada')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cartas_poder');
    }
};
