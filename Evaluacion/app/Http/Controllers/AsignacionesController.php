<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asignacion;
use App\Models\User;
use App\Models\Dispositivo;

class AsignacionesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Mostrar todas las asignaciones
    public function index()
    {
        $asignaciones = Asignacion::with(['usuario', 'dispositivo'])->get();
        $usuarios = User::all();
        $dispositivos = Dispositivo::where('estado', 'disponible')->get(); // solo disponibles

        return view('admin.asignaciones', compact('asignaciones', 'usuarios', 'dispositivos'));
    }

    // Crear nueva asignación
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'dispositivo_id' => 'required|exists:dispositivos,id',
            'motivo' => 'nullable|string|max:255',
            'responsable_entrega' => 'nullable|string|max:255',
            'responsable_recibe' => 'nullable|string|max:255',
        ]);

        $asignacion = Asignacion::create([
            'usuario_id' => $request->usuario_id,
            'dispositivo_id' => $request->dispositivo_id,
            'fecha_asignacion' => now(),
            'motivo' => $request->motivo,
            'responsable_entrega' => $request->responsable_entrega,
            'responsable_recibe' => $request->responsable_recibe,
            'activo' => true,
        ]);

        // Marcar dispositivo como asignado
        $dispositivo = $asignacion->dispositivo;
        $dispositivo->estado = 'asignado';
        $dispositivo->save();

        return redirect()->back()->with('success', 'Dispositivo asignado correctamente.');
    }

    // Devolver dispositivo
    public function devolver(Request $request, $id)
    {
        $asignacion = Asignacion::findOrFail($id);
        $asignacion->fecha_devolucion = now();
        $asignacion->activo = false;
        $asignacion->save();

        // Actualizar estado del dispositivo
        $dispositivo = $asignacion->dispositivo;
        $dispositivo->estado = 'disponible';
        $dispositivo->save();

        return redirect()->back()->with('success', 'Dispositivo devuelto correctamente.');
    }
}
