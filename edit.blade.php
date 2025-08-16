@extends('layouts.app')

@section('content')
<h1>Editar Proyecto</h1>

<form action="{{ route('proyectos.update', $proyecto['id']) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nombre:</label><br>
    <input type="text" name="nombre" value="{{ $proyecto['nombre'] }}" required><br><br>

    <label>Fecha de Inicio:</label><br>
    <input type="date" name="fecha_inicio" value="{{ $proyecto['fecha_inicio'] }}" required><br><br>

    <label>Estado:</label><br>
    <input type="text" name="estado" value="{{ $proyecto['estado'] }}" required><br><br>

    <label>Responsable:</label><br>
    <input type="text" name="responsable" value="{{ $proyecto['responsable'] }}" required><br><br>

    <label>Monto:</label><br>
    <input type="number" name="monto" step="0.01" value="{{ $proyecto['monto'] }}" required><br><br>

    <button type="submit">Actualizar Proyecto</button>
</form>

<a href="{{ route('proyectos.index') }}">Volver a la lista</a>
@endsection
