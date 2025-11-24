@extends('layout.app')
@section('title', 'Editar Lavado')

@section('content')
<h1 class="mb-4">Editar Lavado</h1>

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

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ url('/lavados/'.$lavado->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Tipo</label>
                <select name="tipo" class="form-select">
                    <option value="manual"     {{ $lavado->tipo == 'manual' ? 'selected' : '' }}>Manual</option>
                    <option value="automatico" {{ $lavado->tipo == 'automatico' ? 'selected' : '' }}>Automático</option>
                    <option value="detalle"    {{ $lavado->tipo == 'detalle' ? 'selected' : '' }}>A detalle</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control"
                       value="{{ old('precio', $lavado->precio) }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input type="text" name="descripcion" class="form-control"
                       value="{{ old('descripcion', $lavado->descripcion) }}">
            </div>

            <h4 class="mt-4">Auto asociado</h4>

            <div class="mt-3">
                <div class="d-flex align-items-center border rounded p-2 mb-2">

                    <div class="mb-3">
                        <label>Seleccionar Auto</label>
                        <select name="auto_id" class="form-select">
                            @foreach ($autos as $auto)
                                <option value="{{ $auto->id }}"
                                    {{ ($autoPivot->id == $auto->id) ? 'selected' : '' }}>
                                    {{ $auto->marca }} {{ $auto->modelo }}
                                </option>
                            @endforeach
                        </select>

                        <label>Precio final</label>
                        <input type="number" name="precio_final" class="form-control"
                               value="{{ $autoPivot?->pivot->precio_final }}">

                        <label>Observaciones</label>
                        <textarea name="observaciones" class="form-control">{{ $autoPivot?->pivot->observaciones }}</textarea>

                        <label>Fecha</label>
                        <input type="date" name="fecha" class="form-control"
                               value="{{ $autoPivot?->pivot->fecha }}">
                    </div>

                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Actualizar</button>
            <a href="{{ url('/lavados') }}" class="btn btn-secondary mt-3">Cancelar</a>

        </form>
    </div>
</div>
@endsection
