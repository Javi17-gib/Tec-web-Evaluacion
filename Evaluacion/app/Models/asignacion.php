<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignacion extends Model
{
    use HasFactory;

    protected $table = 'asignaciones';

    protected $fillable = [
    'usuario_id',
    'dispositivo_id',
    'fecha_asignacion',
    'fecha_devolucion',
    'motivo',
    'responsable_entrega',
    'responsable_recibe',
    'activo',
    ];


    // Relaciones
    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function dispositivo()
    {
        return $this->belongsTo(Dispositivo::class, 'dispositivo_id');
    }

    public function cartaPoder()
    {
        return $this->hasOne(CartaPoder::class, 'asignacion_id');
    }
}
