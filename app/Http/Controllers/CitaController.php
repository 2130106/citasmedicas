<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;
use Illuminate\Support\Facades\Log;

class CitaController extends Controller
{
    
public function index()
{
    if (request()->ajax()) {
        $citas = Cita::all();
        return response()->json($citas);
    }

    $pacientes = Paciente::all();
    $citas = Cita::all();
    $medicos = Medico::all();
    return view('auth.citas', compact('citas','pacientes', 'medicos'));
}
    
    public function getEvents()
    {
        $citas = Cita::all();
        return response()->json($citas);
    }

    public function create()
{
    $pacientes = Paciente::all(); // Obtener todos los pacientes

    return route('citas.create', compact('pacientes'));
}

    public function store(Request $request)
    {
        Log::debug($request);
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'paciente' => 'required|string|max:255',
            'medico' => 'required|string|max:255',
            'consultorio' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $cita = Cita::create($request->all());

        if ($request->ajax()) {
            return response()->json(['success' => 'Cita creada exitosamente.', 'cita' => $cita]);
        }

        return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
    }

    public function show($id)
    {
        $cita = Cita::findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        return view('citas.edit', compact('cita'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'paciente' => 'required|string|max:255',
            'medico' => 'required|string|max:255',
            'consultorio' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        $cita = Cita::findOrFail($id);
        $cita->update($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita actualizada exitosamente.');
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }
}

