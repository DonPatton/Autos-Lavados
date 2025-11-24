@extends('layout.app')
@section('title', 'Crear Auto')

@section('content')
<h1 class="mb-4">Ingresar Auto</h1>

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

{{-- Formulario --}}
<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ url('/autos') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Patente</label>
                <input type="text" name="patente" class="form-control" value="{{ old('patente') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" value="{{ old('marca') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Modelo</label>
                <input type="text" name="modelo" class="form-control" value="{{ old('modelo') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Color</label>
                <input type="text" name="color" class="form-control" value="{{ old('color') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Propietario</label>
                <input type="text" name="propietario" class="form-control" value="{{ old('propietario') }}">
            </div>

            <button type="submit" class="btn btn-primary">Guardar</button>
            <a href="{{ url('/autos') }}" class="btn btn-secondary">Cancelar</a>

        </form>

    </div>
</div>
@endsection
