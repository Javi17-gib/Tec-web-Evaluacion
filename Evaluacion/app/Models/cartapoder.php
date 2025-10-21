<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartaPoder extends Model
{
    use HasFactory;

    protected $table = 'carta_poder';

    protected $fillable = [
        'asignacion_id',
        'ruta_pdf',
        'contenido',
        'codigo_qr',
        'generado_por',
        'fecha_generada',
    ];

    // Relación con la asignación
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'asignacion_id');
    }

    // Relación con el usuario que generó la carta
    public function generador()
    {
        return $this->belongsTo(User::class, 'generado_por');
    }
}
