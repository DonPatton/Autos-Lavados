<?php

namespace App\Models;
// Ubica este modelo dentro del directorio App/Models del proyecto

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// Importa la clase base de Eloquent y el módulo para crear datos de prueba

class Lavado extends Model
{
    use HasFactory;
    // Habilita la creación de modelos desde factories para testing o seeds

    // Campos que pueden completarse de manera masiva
    protected $fillable = [
        'tipo',
        'precio',
        'descripcion',
    ];

    // Relación "muchos a muchos" con el modelo Auto
    public function autos()
    {
        return $this->belongsToMany(Auto::class, 'autos_lavados')
                    // Conecta Lavado con Auto usando la tabla pivote "autos_lavados"

                    ->withPivot('fecha', 'precio_final', 'observaciones')
                    // Indica qué columnas adicionales de la tabla pivote deben recuperarse

                    ->withTimestamps();
                    // Usará las columnas created_at y updated_at en la tabla pivote
    }
}
