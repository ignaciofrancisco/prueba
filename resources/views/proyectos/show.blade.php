@extends('layouts.app')

@section('content')
<h1>Detalle del Proyecto</h1>

<ul>
    <li><strong>Id:</strong> {{ $proyecto['id'] }}</li>
    <li><strong>Nombre:</strong> {{ $proyecto['nombre'] }}</li>
    <li><strong>Fecha de Inicio:</strong> {{ $proyecto['fecha_inicio'] }}</li>
    <li><strong>Estado:</strong> {{ $proyecto['estado'] }}</li>
    <li><strong>Responsable:</strong> {{ $proyecto['responsable'] }}</li>
    <li><strong>Monto:</strong> ${{ number_format($proyecto['monto'], 0, ',', '.') }}</li>
</ul>

<a href="{{ route('proyectos.index') }}">Volver a la lista</a>
@endsection
