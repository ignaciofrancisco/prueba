<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Proyecto;

class ProyectoController extends Controller
{
    private $proyectosDefault = [
        ['id' => 1, 'nombre' => 'Proyecto Alpha', 'fecha_inicio' => '2025-06-01', 'estado' => 'En progreso', 'responsable' => 'Juan Pérez', 'monto' => 15000],
        ['id' => 2, 'nombre' => 'Proyecto Beta', 'fecha_inicio' => '2025-07-15', 'estado' => 'Finalizado', 'responsable' => 'María López', 'monto' => 23000],
        ['id' => 3, 'nombre' => 'Proyecto Gamma', 'fecha_inicio' => '2025-08-01', 'estado' => 'Pendiente', 'responsable' => 'Carlos Ruiz', 'monto' => 12000],
    ];

    private function getProyectosSesion()
    {
        if (!session()->has('proyectos')) {
            session(['proyectos' => $this->proyectosDefault]);
        }
        return session('proyectos');
    }

    private function saveProyectosSesion($proyectos)
    {
        session(['proyectos' => $proyectos]);
    }

    private function getAllProyectos()
    {
        $proyectosSesion = $this->getProyectosSesion();

        $proyectosBD = Proyecto::all()->map(function($p) {
            return [
                'id' => $p->id + 1000,
                'nombre' => $p->nombre,
                'fecha_inicio' => $p->fecha_inicio,
                'estado' => $p->estado,
                'responsable' => $p->responsable,
                'monto' => $p->monto,
                'db' => true,
            ];
        })->toArray();

        return array_merge($proyectosSesion, $proyectosBD);
    }

    public function index(Request $request)
    {
        $proyectos = $this->getAllProyectos();
        $valorUF = $this->obtenerUF();

        if ($request->has('query')) {
            $termino = $request->input('query');
            $proyectos = $this->buscarPorTermino($termino);
        }

        return view('proyectos.index', compact('proyectos', 'valorUF'));
    }

    public function show($id)
    {
        $proyecto = collect($this->getAllProyectos())->firstWhere('id', (int)$id);
        if (!$proyecto) abort(404, 'Proyecto no encontrado');
        return view('proyectos.show', compact('proyecto'));
    }

    public function create()
    {
        $usuarioNombre = session('usuario_nombre');
        return view('proyectos.create', compact('usuarioNombre'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'estado' => 'required|string',
            'monto' => 'required|numeric',
        ]);

        $usuarioId = session('usuario_id');
        $usuarioNombre = session('usuario_nombre');

        if (!$usuarioId) {
            abort(403, 'Debe iniciar sesión para crear un proyecto.');
        }

        try {
            Proyecto::create([
                'nombre' => $request->nombre,
                'fecha_inicio' => $request->fecha_inicio,
                'estado' => $request->estado,
                'responsable' => $usuarioNombre,
                'monto' => $request->monto,
                'created_by' => $usuarioId,
            ]);
            return redirect()->route('proyectos.index')->with('success', 'Proyecto creado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->withInput()->with('warning', 'Monto demasiado grande, ingrese un valor válido.');
        }
    }

    public function edit($id)
    {
        $proyecto = collect($this->getAllProyectos())->firstWhere('id', (int)$id);
        if (!$proyecto) abort(404, 'Proyecto no encontrado');

        $usuarioNombre = session('usuario_nombre');

        return view('proyectos.edit', compact('proyecto', 'usuarioNombre'));
    }

    public function update(Request $request, $id)
    {
        $todos = $this->getAllProyectos();
        $proyecto = collect($todos)->firstWhere('id', (int)$id);

        $usuarioNombre = session('usuario_nombre');

        if (isset($proyecto['db']) && $proyecto['db'] === true) {
            $idBD = $id - 1000;
            $p = Proyecto::find($idBD);
            if ($p) {
                try {
                    $p->update([
                        'nombre' => $request->nombre,
                        'fecha_inicio' => $request->fecha_inicio,
                        'estado' => $request->estado,
                        'responsable' => $usuarioNombre,
                        'monto' => $request->monto,
                    ]);
                } catch (\Illuminate\Database\QueryException $e) {
                    return redirect()->back()->withInput()->with('warning', 'Monto demasiado grande, ingrese un valor válido.');
                }
            }
        } else {
            $proyectos = collect($this->getProyectosSesion())->map(function($p) use ($request, $id, $usuarioNombre) {
                if ($p['id'] == (int)$id) {
                    $p['nombre'] = $request->nombre;
                    $p['fecha_inicio'] = $request->fecha_inicio;
                    $p['estado'] = $request->estado;
                    $p['responsable'] = $usuarioNombre;
                    $p['monto'] = $request->monto;
                }
                return $p;
            })->values()->all();
            $this->saveProyectosSesion($proyectos);
        }

        return redirect()->route('proyectos.index')->with('success', 'Proyecto actualizado correctamente.');
    }

    public function delete($id)
    {
        $proyecto = collect($this->getAllProyectos())->firstWhere('id', (int)$id);
        if (!$proyecto) abort(404, 'Proyecto no encontrado');
        return view('proyectos.delete', compact('proyecto'));
    }

    public function destroy($id)
    {
        $todos = $this->getAllProyectos();
        $proyecto = collect($todos)->firstWhere('id', (int)$id);

        if (isset($proyecto['db']) && $proyecto['db'] === true) {
            $idBD = $id - 1000;
            $p = Proyecto::find($idBD);
            if ($p) $p->delete();
        } else {
            $proyectos = collect($this->getProyectosSesion())->reject(fn($p) => $p['id'] == (int)$id)->values()->all();
            $this->saveProyectosSesion($proyectos);
        }

        return redirect()->route('proyectos.index')->with('success', 'Proyecto eliminado correctamente.');
    }

    private function buscarPorTermino($termino)
    {
        $resultadosSesion = collect($this->getProyectosSesion())->filter(function ($p) use ($termino) {
            return (string)$p['id'] === (string)$termino
                || stripos($p['nombre'], $termino) !== false
                || stripos($p['estado'], $termino) !== false
                || stripos($p['responsable'], $termino) !== false;
        })->toArray();

        $resultadosBD = Proyecto::all()->filter(function($p) use ($termino) {
            return (string)($p->id + 1000) === (string)$termino
                || stripos($p->nombre, $termino) !== false
                || stripos($p->estado, $termino) !== false
                || stripos($p->responsable, $termino) !== false;
        })->map(function ($p) {
            return [
                'id' => $p->id + 1000,
                'nombre' => $p->nombre,
                'fecha_inicio' => $p->fecha_inicio,
                'estado' => $p->estado,
                'responsable' => $p->responsable,
                'monto' => $p->monto,
                'db' => true,
            ];
        })->toArray();

        return array_merge($resultadosSesion, $resultadosBD);
    }

    private function obtenerUF()
    {
        try {
            $response = Http::get('https://mindicador.cl/api/uf');
            if ($response->successful()) return $response->json('serie.0.valor');
        } catch (\Exception $e) {
            return null;
        }
        return null;
    }
}

