<!-- resources/views/auth/pacientes.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="mb-4">
        <h3>Pacientes</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Paciente</th>
                    <th>Teléfono</th>
                    <th>Estado</th>
                    <th>Fecha de Cita</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pacientes as $paciente)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $paciente->nombre }}</td>
                        <td>{{ $paciente->telefono }}</td>
                        <td>{{ $paciente->estado }}</td>
                        <td>{{ $paciente->fecha_cita }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div>
        <h3>Agregar Paciente</h3>
        <form method="POST" action="{{ route('pacientes.store') }}">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre del Paciente</label>
                <input id="nombre" type="text" class="form-control" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono</label>
                <input id="telefono" type="text" class="form-control" name="telefono" required>
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input id="estado" type="text" class="form-control" name="estado" required>
            </div>
            <div class="form-group">
                <label for="fecha_cita">Fecha de Cita</label>
                <input id="fecha_cita" type="date" class="form-control" name="fecha_cita">
            </div>
            <button type="submit" class="btn btn-primary">Agregar Paciente</button>
        </form>
    </div>
@endsection
