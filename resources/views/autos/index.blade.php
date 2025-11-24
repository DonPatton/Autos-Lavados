@extends('layout.app')
@section('title', 'autos')
@section('content')
<div class="container">
    <h1>Lista de Autos</h1>

    <a href="{{url ('/autos/create') }} " class="btn btn-primary">Crear</a>
    <form action="{{url('/autos')}}" method="get">
        <input type="text" name="buscar" placeholder="Buscar..." value="{{ request('buscar') }}"> <!-- ECuando la página se recarga → value="{{ request('buscar') }}" rellena el input con lo que vino en la URL.-->
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    
    <table class="table table-striped">
        <tr>
            <th><a href="{{ url('/autos?ordenar=id') }}">ID</a></th> <!-- cuando le das clik, te redirecciona para cargar el nuevo ordenamiento segun la url -->
            <th><a href="{{ url('/autos?odernar=patente') }}">patente</a></th>
            <th><a href="{{ url('/autos?ordenar=marca') }}">marca</a></th>
            <th><a href="{{ url('/autos?ordenar=modelo') }}">modelo</a></th>
            <th><a href="{{ url('/autos?ordenar=color') }}">color</a></th>
            <th><a href="{{ url('/autos?ordenar=propietario') }}">propietario</a></th>
            <th>Editar</th>
            <th>Borrar</th>
        </tr>
        
        @foreach($autos as $m)

        <tr>
            <td>{{ $m->id }}</td>
            <td>{{ $m->patente }}</td>
            <td>{{ $m->marca }}</td>
            <td>{{ $m->modelo }}</td>
            <td>{{ $m->color }}</td>
            <td>{{ $m->propietario }}</td>
            <td> <a href="{{url ('/autos/'. $m->id .'/edit' ) }} " class="btn btn-secondary">Editar</a></td>
            <td>
                <form action="{{ url ('/autos/' . $m->id) }}" method="post">
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
