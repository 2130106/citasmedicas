<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Medico;
use App\Models\Paciente;

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
        return view('auth.citas', compact('citas', 'pacientes', 'medicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'paciente' => 'required|string|max:255',
            'medico' => 'required|string|max:255',
            'consultorio' => 'required|string|max:255',
            'estado' => 'required|integer|in:1,2,3',
        ]);

        $cita = Cita::create($request->all());

        if ($request->ajax()) {
            return response()->json(['success' => 'Cita creada exitosamente.', 'cita' => $cita]);
        }

        return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
    }

    public function create()
    {
        $pacientes = Paciente::all();
        $medicos = Medico::all();
        return view('auth.crear_cita', compact('pacientes', 'medicos'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'paciente' => 'required|string|max:255',
            'medico' => 'required|string|max:255',
            'consultorio' => 'required|string|max:255',
            'estado' => 'required|integer|in:1,2,3',
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

    public function changeStatus(Request $request, $id)
    {
        $cita = Cita::find($id);
        $cita->estado = $request->input('estado');
        $cita->save();

        return redirect()->route('citas.index')->with('success', 'Estado de la cita actualizado.');
    }
}
