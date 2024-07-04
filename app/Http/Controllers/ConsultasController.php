<?php
// app/Http/Controllers/ConsultasController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;

class ConsultasController extends Controller
{
    public function index()
    {
        $consultas = Consulta::all();
        return view('auth.registro_consulta', compact('consultas'));
    }

    public function create()
    {
        return view('consultas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'edad' => 'required|integer|min:0',
            'sexo' => 'required|string|in:masculino,femenino',
            'alergias' => 'required|string|in:si,no',
            'alergias_texto' => 'nullable|string',
            'enfermedades' => 'required|string|in:si,no',
            'enfermedades_texto' => 'nullable|string',
        ]);

        $consulta = Consulta::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'edad' => $request->edad,
            'sexo' => $request->sexo,
            'alergias' => $request->alergias,
            'alergias_texto' => $request->alergias_texto,
            'enfermedades' => $request->enfermedades,
            'enfermedades_texto' => $request->enfermedades_texto,
        ]);

        return redirect()->route('consultas.index')->with('success', 'Consulta registrada exitosamente.');
    }
}
