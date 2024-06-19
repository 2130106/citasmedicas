<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;

class CitaController extends Controller
{
    /**
     * Muestra una lista de todas las citas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $citas = Cita::all(); // Obtener todas las citas
        return view('home', compact('citas')); // Pasar las citas a la vista
    }

    /**
     * Muestra el formulario para crear una nueva cita.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('citas.create');
    }

    /**
     * Almacena una nueva cita en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'paciente' => 'required|string|max:255',
            'medico' => 'required|string|max:255',
            'consultorio' => 'required|string|max:255',
            'estado' => 'required|in:pendiente,confirmada,cancelada',
        ]);

        Cita::create($request->all());

        return redirect()->route('citas.index')->with('success', 'Cita creada exitosamente.');
    }

    /**
     * Muestra los detalles de una cita específica.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $cita = Cita::findOrFail($id);
        return view('citas.show', compact('cita'));
    }

    /**
     * Muestra el formulario para editar una cita específica.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $cita = Cita::findOrFail($id);
        return view('citas.edit', compact('cita'));
    }

    /**
     * Actualiza la información de una cita específica en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Elimina una cita específica de la base de datos.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('citas.index')->with('success', 'Cita eliminada exitosamente.');
    }
}
