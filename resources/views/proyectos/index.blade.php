@extends('layouts.app')

@section('content')
<div style="padding: 20px; font-family: Arial, sans-serif;">
    <h1 style="text-align:center; color:#2c3e50;">Lista de Proyectos</h1>

    {{-- Formulario de búsqueda por ID --}}
    <form action="{{ route('proyectos.index') }}" method="GET" style="margin-bottom: 20px; display:flex; gap:10px; flex-wrap: wrap;">
    <input type="number" name="query" placeholder="Buscar proyecto por ID" value="{{ request('query') }}" required style="padding:5px; flex:1; min-width: 150px;">
    <button type="submit" style="padding:6px 12px; background-color:#3498db; color:#fff; border:none; border-radius:3px; cursor:pointer;">Buscar</button>
</form>


    {{-- Mensaje de proyecto no encontrado --}}
    @if(request()->has('query') && count($proyectos) === 0)
        <p style="color:red; font-weight:bold;">No se encontró ningún proyecto con el ID "{{ request('query') }}".</p>
    @endif

    <p style="font-weight:bold; margin-bottom:20px;">
        Valor UF del día: 
        <span style="color:#e74c3c;">
            @if($valorUF)
                ${{ number_format($valorUF, 2, ',', '.') }}
            @else
                No disponible
            @endif
        </span>
    </p>

    <div style="margin-bottom: 20px;">
        <a href="{{ route('proyectos.create') }}" style="padding:8px 16px; background-color:#2ecc71; color:#fff; text-decoration:none; border-radius:4px;">Agregar Proyecto</a>
    </div>

    {{-- Tabla de proyectos --}}
    <div style="width: 100%; overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; min-width: 800px;">
            <thead style="background-color:#3498db; color:#fff;">
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Fecha Inicio</th>
                    <th>Estado</th>
                    <th>Responsable</th>
                    <th>Monto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($proyectos as $proyecto)
                <tr style="text-align:center; border-bottom:1px solid #ddd;">
                    <td>{{ $proyecto['id'] }}</td>
                    <td>{{ $proyecto['nombre'] }}</td>
                    <td>{{ $proyecto['fecha_inicio'] }}</td>
                    <td>{{ $proyecto['estado'] }}</td>
                    <td>{{ $proyecto['responsable'] }}</td>
                    <td>${{ number_format($proyecto['monto'], 0, ',', '.') }}</td>
                    <td>
                        <a href="{{ route('proyectos.show', $proyecto['id']) }}" style="color:#2980b9;">Ver</a> |
                        <a href="{{ route('proyectos.edit', $proyecto['id']) }}" style="color:#f39c12;">Editar</a> |
                        <a href="{{ route('proyectos.delete', $proyecto['id']) }}" style="color:#e74c3c;">Eliminar</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:red; font-weight:bold;">No hay proyectos para mostrar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection


