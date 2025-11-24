@extends('layout.app')
@section('title', 'lavados')
@section('content')
<div class="container">
    <h1>Lista de Lavados</h1>

    <a href="{{url ('/lavados/create') }} " class="btn btn-primary">Crear</a>
    <form action="{{url('/lavados')}}" method="get">
        <input type="text" name="buscar" placeholder="Buscar..." value="{{ request('buscar') }}">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    
    <table class="table table-striped">
        <tr>
            <th><a href="{{ url('/lavados?ordenar=id') }}">ID</a></th>
            <th><a href="{{ url('/lavados?odernar=tipo') }}">Tipo</a></th>
            <th><a href="{{ url('/lavados?ordenar=precio') }}">Precio</a></th>
            <th><a href="{{ url('/lavados?ordenar=descripcion') }}">descripcion</a></th>
            <th>auto</th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        @foreach($lavados as $m)
        <tr>
            <td>{{ $m->id }}</td>
            <td>{{ $m->tipo }}</td>
            <td>{{ $m->precio }}</td>
            <td>{{ $m->descripcion }}</td>
            <td>
                @foreach ($m->autos as $auto)
                    <div>
                        {{ $auto->marca }} {{ $auto->modelo }}
                        (Precio final: {{ $auto->pivot->precio_final }},
                         Fecha: {{ $auto->pivot->fecha }},
                         Obs: {{ $auto->pivot->observaciones }})
                    </div>
                @endforeach
            </td>
            <td> <a href="{{url ('/lavados/'. $m->id .'/edit' ) }} " class="btn btn-secondary">Editar</a></td>
            <td>
                <form action="{{ url ('/lavados/' . $m->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
                
            </td>
            
            
        </tr>
        @endforeach
    </table>
</div>
@endsection
