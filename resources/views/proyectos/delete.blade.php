@extends('layouts.app')

@section('content')
<h1>Eliminar Proyecto</h1>

<p>¿Está seguro que desea eliminar el proyecto <strong>{{ $proyecto['nombre'] }}</strong>?</p>

<form action="{{ route('proyectos.destroy', $proyecto['id']) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit" style="background-color:red; color:white;">Eliminar</button>
    <a href="{{ route('proyectos.index') }}">Cancelar</a>
</form>
@endsection
