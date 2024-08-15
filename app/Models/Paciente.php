<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
    protected $fillable = ['nombre', 'apellido', 'edad', 'genero', 'telefono','fecha_nac', 'email'];
}
