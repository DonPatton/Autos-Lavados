<?php

namespace App\Http\Controllers;

// Importa los modelos y herramientas necesarias
use App\Models\Lavado;  // Representa los lavados en la base de datos
use App\Models\Auto;    // Representa los autos
use Illuminate\Http\Request;

class LavadoController extends Controller
{
    /**
     * Muestra la lista de lavados.
     */
    public function index(request $request)
    {
        // Crea la consulta que luego se filtrará y ordenará
        $query = Lavado::query();

        // Si el usuario envió un texto en "buscar"
        if ($request->filled('buscar')) {
            $buscar = $request->input('buscar'); // Obtiene ese texto

            // Agrega condiciones para buscar por tipo o descripción
            $query->where('tipo', 'like', "%{$buscar}%")
                  ->orWhere('descripcion', 'like', "%{$buscar}%");
        }

        // Toma el campo por el cual ordenar, o usa "id" si no se indicó ninguno
        $orden = $request->input('ordenar', 'id');

        // Ejecuta la consulta y obtiene los lavados
        $lavados = $query->orderBy($orden)->get();

        // Envía los datos a la vista
        return view('lavados.index', compact('lavados'));
    }

    /**
     * Muestra el formulario para crear un lavado.
     */
    public function create()
    {
        // Obtiene todos los autos para mostrarlos en el formulario
        $autos = Auto::all();

        return view('lavados.create', compact('autos'));
    }

    /**
     * Guarda un nuevo lavado en la base de datos.
     */
    public function store(Request $request)
    {
        // 1. Valida todos los datos recibidos
        $validated = $request->validate([
            'tipo'          => 'required|string|max:255',
            'precio'        => 'required|numeric',
            'descripcion'   => 'required|nullable|string',

            // Datos para la tabla pivote auto_lavado
            'auto_id'       => 'required|exists:autos,id',
            'precio_final'  => 'required|numeric',
            'observaciones' => 'nullable|string',
            'fecha'         => 'required|date',
        ]);

        // 2. Crea el lavado en su tabla correspondiente
        $lavado = Lavado::create([
            'tipo'        => $validated['tipo'],
            'precio'      => $validated['precio'],
            'descripcion' => $validated['descripcion'],
        ]);

        // 3. Crea la relación con el auto en la tabla pivote
        $lavado->autos()->attach($validated['auto_id'], [
            'precio_final'  => $validated['precio_final'],
            'observaciones' => $validated['observaciones'],
            'fecha'         => $validated['fecha'],
        ]);

        // 4. Redirige a la lista de lavados
        return redirect('/lavados');
    }

    /**
     * Muestra un lavado específico (sin usar).
     */
    public function show(Lavado $lavado)
    {
        // Sin implementación por ahora
    }

    /**
     * Muestra el formulario para editar un lavado.
     */
    public function edit(Lavado $lavado)
    {
        // Todos los autos disponibles (para el select)
        $autos = Auto::all();

        // Obtiene el auto asociado a este lavado (solo uno)
        $autoPivot = $lavado->autos()->first(); // Puede ser null si no existe relación

        return view('lavados.edit', compact('lavado', 'autos', 'autoPivot'));
    }

    /**
     * Actualiza un lavado existente.
     */
    public function update(Request $request, Lavado $lavado)
    {
        // 1. Valida los datos enviados
        $validated = $request->validate([
            'tipo'          => 'required|string|max:255',
            'precio'        => 'required|numeric',
            'descripcion'   => 'required|string',

            // Datos de la tabla pivote
            'auto_id'       => 'required|exists:autos,id',
            'precio_final'  => 'required|numeric',
            'observaciones' => 'required|string',
            'fecha'         => 'required|date',
        ]);

        // 2. Actualiza los datos del lavado en su tabla
        $lavado->update([
            'tipo'        => $validated['tipo'],
            'precio'      => $validated['precio'],
            'descripcion' => $validated['descripcion'],
        ]);

        // 3. Actualiza la relación en la tabla pivote (solo un auto)
        $lavado->autos()->sync([
            $validated['auto_id'] => [
                'precio_final'  => $validated['precio_final'],
                'observaciones' => $validated['observaciones'],
                'fecha'         => $validated['fecha']
            ]
        ]);

        return redirect('/lavados');
    }

    /**
     * Elimina un lavado.
     */
    public function destroy(Lavado $lavado)
    {
        // Elimina el lavado de la base de datos
        $lavado->delete();

        // Regresa al listado
        return redirect('/lavados');
    }
}
