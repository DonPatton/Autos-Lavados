<?php

namespace App\Http\Controllers;

// Importa clases necesarias
use Illuminate\Http\Request;     // Sirve para leer datos enviados desde formularios
use App\Models\Auto;             // Modelo que representa los autos en la base de datos
use App\Http\Requests\AutoRequest; // Validación de datos para crear/editar autos

class AutoController extends Controller
{
    public function index(Request $request)
    {
        // Crea una consulta vacía que se irá armando según los filtros
        $query = Auto::query();

        // Si el usuario escribió algo en el campo "buscar"
        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar'); // Obtiene ese texto

            // Agrega condiciones para buscar coincidencias en varios campos
            $query->where('patente', 'like', "%{$buscar}%")
                  ->orWhere('marca', 'like', "%{$buscar}%")
                  ->orWhere('modelo', 'like', "%{$buscar}%");
        }

        // Lee el criterio de ordenamiento o usa "id" si no se eligió ninguno
        $orden = $request->input('ordenar', 'id');

        // Ejecuta la consulta, ordena los resultados y los guarda
        $autos = $query->orderBy($orden)->get();

        // Envía los autos a la vista que los va a mostrar
        return view('autos.index', compact('autos'));
    }

    public function create()
    {
        // Muestra la vista con el formulario para crear un auto
        return view('autos.create');
    }

    public function store(AutoRequest $request)
    {
        // Crea un auto nuevo usando solo datos validados
        Auto::create($request->validated());

        // Vuelve a la lista de autos
        return redirect('/autos');
    }

    public function edit(Auto $auto)
    {
        // Muestra la vista para editar un auto específico
        return view('autos.edit', compact('auto'));
    }

    public function update(AutoRequest $request, Auto $auto)
    {
        // Actualiza el auto con datos validados
        $auto->update($request->validated());

        // Regresa a la lista de autos
        return redirect('/autos');
    }

    public function destroy(Auto $auto)
    {
        // Elimina el auto de la base de datos
        $auto->delete();

        // Vuelve a la lista de autos
        return redirect('/autos');
    }
}
