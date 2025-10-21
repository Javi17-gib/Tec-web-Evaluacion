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
        'codigo_qr',
    ];

    // Relaciones
    public function asignacion()
    {
        return $this->belongsTo(Asignacion::class, 'asignacion_id');
    }
}
