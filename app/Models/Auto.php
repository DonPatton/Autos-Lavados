<?php

namespace App\Models;
// Define en qué carpeta está este modelo dentro del proyecto

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Importa la base de Eloquent y el sistema de factories para crear datos de prueba

class Auto extends Model
{
    use HasFactory;
    // Activa la funcionalidad para generar instancias de Auto en pruebas o seeds

    // Lista de campos permitidos para asignación masiva
    protected $fillable = [
        'patente',
        'marca',
        'modelo',
        'color',
        'propietario',
    ];

    // Relación "muchos a muchos" entre Auto y Lavado
    public function lavados()
    {
        return $this->belongsToMany(Lavado::class, 'autos_lavados')
                    // Conecta Auto con Lavado usando la tabla pivote "autos_lavados"

                    ->withPivot('fecha', 'precio_final', 'observaciones')
                    // Indica qué columnas adicionales debe cargar desde la tabla pivote

                    ->withTimestamps();
                    // Registra automáticamente created_at y updated_at en la tabla pivote
    }
}
