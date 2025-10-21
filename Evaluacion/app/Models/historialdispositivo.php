<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistorialDispositivo extends Model
{
    use HasFactory;

    protected $table = 'historial_dispositivo';

    protected $fillable = [
        'dispositivo_id',
        'usuario_id',
        'accion',
        'fecha',
        'detalles',
    ];

    // Relaciones
    public function dispositivo()
    {
        return $this->belongsTo(Dispositivo::class, 'dispositivo_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
