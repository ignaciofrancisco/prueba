@extends('layouts.app')

@section('content')
<div style="padding: 20px; font-family: Arial, sans-serif; max-width: 800px; margin:auto;">
    <h1 style="text-align:center; color:#2c3e50;">Editar Proyecto</h1>
    @if (session('warning'))
    <div class="bg-yellow-100 text-yellow-700 p-3 rounded mb-4">
        {{ session('warning') }}
    </div>
@endif

    <form action="{{ route('proyectos.update', $proyecto['id']) }}" method="POST" style="display:flex; flex-direction:column; gap:10px;">
        @csrf
        @method('PUT')

        <label>Nombre:</label>
        <input type="text" name="nombre" value="{{ $proyecto['nombre'] }}" required style="padding:5px;">

        <label>Fecha Inicio:</label>
        <input type="date" name="fecha_inicio" value="{{ $proyecto['fecha_inicio'] }}" required style="padding:5px;">

        <label>Estado:</label>
        <select name="estado" required style="padding:5px;">
            <option value="pendiente" {{ $proyecto['estado'] == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
            <option value="en progreso" {{ $proyecto['estado'] == 'en progreso' ? 'selected' : '' }}>En progreso</option>
            <option value="finalizado" {{ $proyecto['estado'] == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
        </select>

        <label>Responsable:</label>
        <input type="text" name="responsable_display" value="{{ session('usuario_nombre') }}" readonly disabled style="padding:5px; background-color:#f0f0f0;">
        <input type="hidden" name="responsable" value="{{ session('usuario_nombre') }}">

        <label>Monto:</label>
        <input type="number" name="monto" value="{{ $proyecto['monto'] }}" required style="padding:5px;">

        <button type="submit" style="padding:8px 16px; background-color:#2ecc71; color:#fff; border:none; border-radius:4px; cursor:pointer;">
            Guardar Cambios
        </button>
    </form>
</div>
@endsection
