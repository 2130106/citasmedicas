@extends('layouts.app')

@section('content')
    <div class="table-container">
        <h2>Citas</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Consultorio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($citas as $cita)
                <tr>
                    <td>{{ $cita->id }}</td>
                    <td>{{ $cita->fecha }}</td>
                    <td>{{ $cita->hora }}</td>
                    <td>{{ $cita->paciente }}</td>
                    <td>{{ $cita->medico }}</td>
                    <td>{{ $cita->consultorio }}</td>
                    <td>{{ ucfirst($cita->estado) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botón para agregar cita -->
    <div class="add-button">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addCitaModal">Agregar Cita</button>
    </div>

    <!-- Modal para agregar cita -->
    <div class="modal fade" id="addCitaModal" tabindex="-1" role="dialog" aria-labelledby="addCitaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCitaModalLabel">Agregar Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('citas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="text" id="fecha" name="fecha" class="form-control" placeholder="Selecciona la fecha..." readonly>
                        </div>
                        <div class="form-group">
                            <label for="hora">Hora</label>
                            <input type="time" id="hora" name="hora" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="paciente">Paciente</label>
                            <input type="text" id="paciente" name="paciente" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="medico">Médico</label>
                            <input type="text" id="medico" name="medico" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="consultorio">Consultorio</label>
                            <input type="text" id="consultorio" name="consultorio" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="estado" name="estado" class="form-control">
                                <option value="pendiente">Pendiente</option>
                                <option value="confirmada">Confirmada</option>
                                <option value="cancelada">Cancelada</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
