<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function registerWeb(Request $request)
    {
        // Validaciones en español
        $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:usuarios,correo',
            'clave' => 'required|string|min:6|confirmed', // Para confirmar clave, agrega input "clave_confirmation" en el form
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede superar los 255 caracteres.',
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo debe ser válido.',
            'correo.unique' => 'Este correo ya está registrado.',
            'clave.required' => 'La clave es obligatoria.',
            'clave.string' => 'La clave debe ser texto.',
            'clave.min' => 'La clave debe tener al menos 6 caracteres.',
            'clave.confirmed' => 'Las claves no coinciden.',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'clave' => Hash::make($request->clave),
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado correctamente. Ahora inicia sesión.');
    }

    public function loginWeb(Request $request)
    {
        $request->validate([
            'correo' => 'required|email',
            'clave' => 'required|string',
        ], [
            'correo.required' => 'El correo es obligatorio.',
            'correo.email' => 'El correo debe ser válido.',
            'clave.required' => 'La clave es obligatoria.',
            'clave.string' => 'La clave debe ser texto.',
        ]);

        $usuario = Usuario::where('correo', $request->correo)->first();

        if (!$usuario || !Hash::check($request->clave, $usuario->clave)) {
            return back()->withErrors(['correo' => 'Correo o clave incorrectos'])->withInput();
        }

        // Guardar sesión del usuario
        session([
            'usuario_id' => $usuario->id,
            'usuario_nombre' => $usuario->nombre
        ]);

        // Inicializar los proyectos en sesión si no existen
        if (!session()->has('proyectos')) {
            session(['proyectos' => [
                ['id' => 1, 'nombre' => 'Proyecto Alpha', 'fecha_inicio' => '2025-06-01', 'estado' => 'En progreso', 'responsable' => 'Juan Pérez', 'monto' => 15000],
                ['id' => 2, 'nombre' => 'Proyecto Beta', 'fecha_inicio' => '2025-07-15', 'estado' => 'Finalizado', 'responsable' => 'María López', 'monto' => 23000],
                ['id' => 3, 'nombre' => 'Proyecto Gamma', 'fecha_inicio' => '2025-08-01', 'estado' => 'Pendiente', 'responsable' => 'Carlos Ruiz', 'monto' => 12000],
            ]]);
        }

        return redirect()->route('proyectos.index');
    }

    public function logoutWeb(Request $request) 
    {
        // Limpiar los datos de sesión manualmente
        $request->session()->forget(['usuario_id', 'usuario_nombre', 'proyectos']);
        $request->session()->flush(); // Limpia toda la sesión
        return redirect()->route('login');
    }
}
