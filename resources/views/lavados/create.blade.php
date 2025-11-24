@extends('layout.app')
@section('title', 'Crear Lavado')

@section('content')
<h1 class="mb-4">Crear Lavado</h1>

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

        <form action="{{ url('/lavados') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <selecT name="tipo">
                    <option value="manual">Manual</option>
                    <option value="automatico">Automatico</option>
                    <option value="detalle">A detalle</option>
                </selecT>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="numeric" name="precio" class="form-control"
                       value="{{ old('precio') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Descipcion</label>
                <input type="text" name="descripcion" class="form-control"
                       value="{{ old('descripcion') }}">
            </div>

            <h4 class="mt-4">Lista de Autos</h4>

            <div class="mt-3">
                    <div class="d-flex align-items-center border rounded p-2 mb-2">

                        {{--  Seleccionar auto --}}
                        <div class="mb-3">
                            <label>Seleccionar Auto</label>
                            <select name="auto_id" id="auto_id" class="form-select">
                                @foreach ($autos as $auto)
                                    <option value="{{ $auto->id }}">
                                        {{ $auto->marca }} {{ $auto->modelo }}
                                    </option>
                                @endforeach
                            </select>

                            <label>Precio final</label>
                            <input type="number" name="precio_final" class="form-control" value="{{ old('precio_final') }}">

                            <label>Observaciones</label>
                            <textarea name="observaciones" class="form-control" value="{{ old('observaciones') }}"></textarea>

                            <label>Fecha</label>
                            <input type="date" name="fecha" class="form-control" value="{{ old('fecha') }}">
                        </div>
                    </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Guardar</button>
            <a href="{{ url('/lavados') }}" class="btn btn-secondary mt-3">Cancelar</a>

        </form>

    </div>
</div>
@endsection
