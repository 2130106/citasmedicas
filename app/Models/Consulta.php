<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    // Nombre de la tabla asociada al modelo
    protected $table = 'consultas';

    // Campos que se pueden asignar en masa
    protected $fillable = [
        'cita_id',
        'alergias',
        'alergias_texto',
        'enfermedades',
        'enfermedades_texto',
        'estatura',
        'peso',
        'temperatura',
        'motivo_consulta',
        'notas',
        'total',
    ];

    public function servicios()
    {
        return $this->belongsToMany(Servicio::class, 'consulta_servicio', 'consulta_id', 'servicio_id');
    }


}
