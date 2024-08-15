<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente;

class PDFController extends Controller
{
    public function downloadConsultationForm($id)
    {
        $consulta = \App\Models\Consulta::findOrFail($id);
        $servicios = \App\Models\Servicio::all(); // Ajusta según sea necesario

        // Obtén la cita específica con las relaciones 'paciente' y 'medico'
        $cita = \App\Models\Cita::findOrFail($consulta->cita_id)->first();

        $paciente = Paciente::findOrFail($cita->paciente);
        $medico = User::findOrFail($cita->medico);

        // Carga la vista para el PDF

        $pdf = Pdf::loadView('auth.consultation_form', compact('consulta', 'servicios', 'cita','paciente','medico'));

        // Descarga el PDF
        return $pdf->download('consulta_' . $id . '.pdf');
    }
}
