<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    // El nombre de la tabla asociada al modelo
    protected $table = 'servicios';

    // Los campos que se pueden asignar masivamente
    protected $fillable = ['nombre', 'precio'];

    public function consultas()
    {
        return $this->belongsToMany(Consulta::class, 'consulta_servicio');
    }

}
