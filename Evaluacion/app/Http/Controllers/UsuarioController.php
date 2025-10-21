<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth'); // protege las rutas con autenticación
    }

    // Mostrar la vista con los usuarios
    public function getUsuarios()
    {
        $usuarios = User::all();
        return view('admin.users')->with('usuarios', $usuarios);
    }

    // Crear un usuario
    public function createUsuarios(Request $request)
    {
        // Validación de campos
        $request->validate([
            'nombre' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6', // necesita campo password_confirmation en el form
        ]);

        // Guardar registro
        $user = new User();
        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->telefono = $request->telefono ?? null;
        $user->puesto = $request->puesto ?? null;
        $user->activo = $request->activo ? true : false;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('usuarios.get')->with('success', 'Usuario agregado correctamente.');
    }

    // Eliminar un usuario
    public function deleteUsuarios(Request $request)
    {
        $usuario = User::findOrFail($request->id);
        $usuario->delete();

        return redirect()->route('usuarios.get')->with('success', 'Usuario eliminado correctamente.');
    }
}
