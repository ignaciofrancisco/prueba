@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin:auto; padding:20px; background-color:#fff; border-radius:8px; box-shadow:0 0 10px rgba(0,0,0,0.1);">
    <h1 style="text-align:center; color:#2c3e50; margin-bottom:25px;">Crear Nuevo Proyecto</h1>
    @if (session('warning'))
    <div class="bg-yellow-100 text-yellow-700 p-3 rounded mb-4">
        {{ session('warning') }}
    </div>
@endif

    <form method="POST" action="{{ route('proyectos.store') }}">
        @csrf

        <div style="margin-bottom:15px;">
            <label for="nombre" style="font-weight:bold;">Nombre del Proyecto:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" required>
        </div>

        <div style="margin-bottom:15px;">
            <label for="fecha_inicio" style="font-weight:bold;">Fecha de Inicio:</label>
            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" required>
        </div>

        <div style="margin-bottom:15px;">
            <label for="estado" style="font-weight:bold;">Estado:</label>
            <select name="estado" id="estado" class="form-control" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" required>
                <option value="pendiente">Pendiente</option>
                <option value="en progreso">En progreso</option>
                <option value="finalizado">Finalizado</option>
            </select>
        </div>

        <div style="margin-bottom:15px;">
            <label for="responsable" style="font-weight:bold;">Responsable:</label>
            <input type="text" name="responsable_display" id="responsable" class="form-control" 
                style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc; background-color:#f0f0f0;" 
                value="{{ session('usuario_nombre') }}" readonly disabled>
            <input type="hidden" name="responsable" value="{{ session('usuario_nombre') }}">
        </div>

        <div style="margin-bottom:15px;">
            <label for="monto" style="font-weight:bold;">Monto:</label>
            <input type="number" name="monto" id="monto" class="form-control" style="width:100%; padding:8px; border-radius:4px; border:1px solid #ccc;" required>
        </div>

        <button type="submit" style="padding:10px 20px; background-color:#2ecc71; color:#fff; border:none; border-radius:4px; cursor:pointer; font-weight:bold;">Guardar Proyecto</button>
    </form>

    <a href="{{ route('proyectos.index') }}" style="display:inline-block; margin-top:15px; color:#3498db;">Volver a la lista</a>
</div>
@endsection
