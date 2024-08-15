<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function downloadConsultationForm($id)
    {
        // Obtén los datos necesarios para el PDF
        $consulta = \App\Models\Consulta::findOrFail($id);
        $servicios = \App\Models\Servicio::all(); // Ajusta según sea necesario

        // Carga la vista para el PDF
        $pdf = Pdf::loadView('auth.consultation_form', compact('consulta', 'servicios'));

        // Descarga el PDF
        return $pdf->download('consulta_' . $id . '.pdf');
    }
}
