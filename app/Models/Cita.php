<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora',
        'paciente',
        'medico',
        'consultorio',
        'estado',
    ];

    // Estado constants
    const ESTADO_PENDIENTE = 2;
    const ESTADO_CONFIRMADA = 1;
    const ESTADO_CANCELADA = 3;

    // Accessor to get the state name
    public function getEstadoNombreAttribute()
    {
        switch ($this->estado) {
            case self::ESTADO_CONFIRMADA:
                return 'Confirmada';
            case self::ESTADO_CANCELADA:
                return 'Cancelada';
            case self::ESTADO_PENDIENTE:
            default:
                return 'Pendiente';
        }
    }
}
