@extends('layout.app')
@section('title', 'Editar Auto')

@section('content')
<h1 class="mb-4">Editar Auto</h1>

{{-- Errores --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Corrige los siguientes errores:</strong>
        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $error) {{-- array que recorre todos los errores --}}
                <li>{{ $error }}</li> 
            @endforeach
        </ul>
    </div>
@endif

{{-- Formulario dentro de una card --}}
<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ url('/autos/'.$auto->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="patente" class="form-label">Patente</label>
                <input type="text" name="patente" id="patente" 
                       class="form-control"
                       value="{{ old('patente', $auto->patente) }}">
            </div>

            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" id="marca" 
                       class="form-control"
                       value="{{ old('marca', $auto->marca) }}">
            </div>

            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" name="modelo" id="modelo" 
                       class="form-control"
                       value="{{ old('modelo', $auto->modelo) }}">
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <input type="text" step="0.01" name="color" id="color" 
                       class="form-control"
                       value="{{ old('color', $auto->color) }}">
            </div>

            <div class="mb-3">
                <label for="propietario" class="form-label">Propietario</label>
                <input type="text" name="propietario" id="propietario" 
                       class="form-control"
                       value="{{ old('propietario', $auto->propietario) }}">
            </div>

            <button type="submit" class="btn btn-primary">Actualizar</button>
            <a href="{{ url('/autos') }}" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
</div>
@endsection
