<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    use HasFactory;

    protected $table = 'dispositivos';

    protected $fillable = [
        'nombre',
        'marca',
        'modelo',
        'numero_serie',
        'estado',
        'observaciones',
    ];

    // Relaciones
    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class, 'dispositivo_id');
    }

    public function historial()
    {
        return $this->hasMany(HistorialDispositivo::class, 'dispositivo_id');
    }
}
