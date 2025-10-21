<?php

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
        // Tabla users
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');                        // nombre completo
            $table->string('email')->unique();             // email
            $table->string('telefono', 30)->nullable();     // teléfono opcional
            $table->string('puesto', 100)->nullable();      // puesto del usuario
            $table->boolean('activo')->default(true);       // activo/inactivo
            $table->string('password');                     // contraseña
            $table->rememberToken();                        // token para "recordarme"
            $table->timestamps();
        });

        // Tabla password_reset_tokens
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Tabla sessions (para SESSION_DRIVER=database)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index()->constrained('users')->nullOnDelete();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
    }
};
