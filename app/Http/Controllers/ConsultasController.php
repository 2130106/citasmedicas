<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consulta;
use App\Models\Servicio;
use App\Models\Cita;

class ConsultasController extends Controller
{
    public function index()
    {
        $consultas = Consulta::all();
        $servicios = Servicio::all();
        return view('auth.citas', compact('consultas', 'servicios'));
    }

    public function create(Request $request)
    {
        $cita_id = $request->query('cita_id');
        
        $consulta = Consulta::where('cita_id', $cita_id)->first();

        $servicios = Servicio::all();
        
        

        return view('auth.registro_consultas', [
            'consulta' => $consulta,
            'servicios' => $servicios,
        ]);

    }

    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'cita_id' => 'nullable|numeric',
                'alergias' =>'required|string',
                'alergias_texto' => 'nullable|string',
                'enfermedades' =>'required|string',
                'enfermedades_texto' => 'nullable|string',
                'estatura' => 'nullable|numeric',
                'peso' => 'nullable|numeric',
                'temperatura' => 'nullable|numeric',
               'motivo_consulta' => 'nullable|string',
                'notas' => 'nullable|string',
               'servicios' => 'nullable|array',
               'servicios.*' => 'exists:servicios,id',
                'total' =>'required|numeric',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Devuelve los errores de validación con detalles adicionales
            return back()->withErrors($e->errors())->withInput();
        }

        $serviciosIds = [];
        if (is_array($validatedData['servicios']) && !empty($validatedData['servicios'])) {
            foreach ($validatedData['servicios'] as $servicioId) {
                $serviciosIds[] = $servicioId;
            }
        }

        // Buscar si ya existe una consulta con el mismo cita_id
        $consulta = Consulta::where('cita_id', $validatedData['cita_id'])->first();

        // Si existe, se actualiza; si no, se crea una nueva
        if ($consulta) {
            // Actualizar la consulta existente
            $consulta->alergias = $validatedData['alergias'];
            $consulta->alergias_texto = $validatedData['alergias_texto'] ?? null;
            $consulta->enfermedades = $validatedData['enfermedades'];
            $consulta->enfermedades_texto = $validatedData['enfermedades_texto'] ?? null;
            $consulta->estatura = $validatedData['estatura'] ?? null;
            $consulta->peso = $validatedData['peso'] ?? null;
            $consulta->temperatura = $validatedData['temperatura'] ?? null;
            $consulta->motivo_consulta = $validatedData['motivo_consulta'] ?? null;
            $consulta->notas = $validatedData['notas'] ?? null;
            $consulta->total = $validatedData['total'];

            // Guardar la consulta actualizada
            $consulta->save();

            if (!empty($serviciosIds)) {
                $consulta->servicios()->sync($serviciosIds);
            } else {
                $consulta->servicios()->detach(); // Eliminar todos los servicios si no se seleccionaron
            }

            // Redireccionar con mensaje de éxito
            return redirect()->route('citas.index')->with('success', 'Consulta actualizada exitosamente.');
        } else {
            // Crear una nueva consulta
            $consulta = new Consulta();
            $consulta->cita_id = $validatedData['cita_id'];
            $consulta->alergias = $validatedData['alergias'];
            $consulta->alergias_texto = $validatedData['alergias_texto'] ?? null;
            $consulta->enfermedades = $validatedData['enfermedades'];
            $consulta->enfermedades_texto = $validatedData['enfermedades_texto'] ?? null;
            $consulta->estatura = $validatedData['estatura'] ?? null;
            $consulta->peso = $validatedData['peso'] ?? null;
            $consulta->temperatura = $validatedData['temperatura'] ?? null;
            $consulta->motivo_consulta = $validatedData['motivo_consulta'] ?? null;
            $consulta->notas = $validatedData['notas'] ?? null;
            $consulta->total = $validatedData['total'];

            // Guardar la nueva consulta
            $consulta->save();

            // Asignar los servicios seleccionados a la consulta
            if (isset($validatedData['servicios'])) {
                $consulta->servicios()->attach($validatedData['servicios']);
            }

            // Redireccionar con mensaje de éxito
            return redirect()->route('citas.index')->with('success', 'Consulta registrada exitosamente.');
        }
    }



    public function show($id)
    {
        $cita = Cita::findOrFail($id);
        $consulta = Consulta::where('cita_id', $id)->first(); // O usa `find($consulta_id)`
        $servicios = Servicio::all();
        return view('auth.registro_consulta', compact('cita','servicios','consulta'));
    }

    private function calculateTotal($servicios)
    {
        $total = 0;

        foreach ($servicios as $servicio_id) {
            $servicio = Servicio::findOrFail($servicio_id);
            $total += $servicio->precio; // Suponiendo que tienes un campo 'precio' en tu tabla 'servicios'
        }

        return $total;
    }
}
