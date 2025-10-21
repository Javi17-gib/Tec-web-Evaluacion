<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dispositivo;

class DispositivosController extends Controller
{
    public function getDispositivos()
    {
        $dispositivos = Dispositivo::all();
        return view('admin.dispositivos', compact('dispositivos'));
    }

    public function createDispositivo(Request $request)
    {
        $request->validate([
        'tipo' => 'required|string|max:50',
        'marca' => 'nullable|string|max:255',
        'modelo' => 'nullable|string|max:255',
        'serial' => 'required|string|max:255|unique:dispositivos,serial',
        'estado' => 'required|string|max:50',
        'observaciones' => 'nullable|string',
        ]);


        Dispositivo::create($request->all());

        return redirect()->back()->with('success', 'Dispositivo agregado correctamente.');
    }
}
