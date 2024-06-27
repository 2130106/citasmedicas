<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #495057;
            margin: 0;
        }
        .sidebar {
            width: 250px;
            background-color: #ffffff;
            color: white;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
        }
        .sidebar a {
            color: black;
            padding: 15px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .header {
            background-color: #9370DB;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .user-info {
            background-color: #9370DB;
            display: flex;
            align-items: center;
        }
        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .search-bar {
            flex: 1;
            text-align: center;
        }
        .search-bar input {
            width: 300px;
            padding: 5px;
        }
        .main-content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .form-control {
            margin-bottom: 10px;
        }
       
    </style>
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }
        .table-container {
            padding: 20px;
        }
        .add-button {
            text-align: right;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="user-info text-center p-3">
            <img src="{{ asset('img/logoconsultorio.jpeg') }}" alt="User Image">
            <span>{{ Auth::user()->name }}</span>
        </div>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('citas.index') }}">Citas</a>
        <a href="{{ route('pacientes.index') }}">Pacientes</a>
        <a href="#">Médicos</a>
        <a href="#">Usuarios</a>
    </div>
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
                    <th>Acciones</th>
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
                    <td>
                        <form action="{{ route('citas.destroy', $cita->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

   
    <div class="add-button">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addCitaModal">Agregar Cita</button>
    </div>

    <div class="modal fade" id="addCitaModal" tabindex="-1" role="dialog" aria-labelledby="addCitaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCitaModalLabel">Agregar Cita</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('citas.store') }}" method="POST" id="addCitaForm">
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
                            <select id="paciente" name="paciente" class="form-control">
                                @foreach($pacientes as $paciente)
                                    <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
                                @endforeach
                            </select>
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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script>
    $(document).ready(function() {
        // Función para cargar citas desde el servidor
        function fetchCitas() {
            return $.ajax({
                url: "{{ route('citas.index') }}",
                method: 'GET',
                dataType: 'json'
            });
        }

        // Función para convertir citas a eventos del calendario (si lo usas)
        function convertCitasToEvents(citas) {
            return citas.map(cita => ({
                title: cita.paciente,
                start: cita.fecha + 'T' + cita.hora,
                description: cita.medico + ' - ' + cita.consultorio,
                status: cita.estado
            }));
        }

        // Función para inicializar el calendario (si lo usas)
        function initializeCalendar(citas) {
            $('#calendar').fullCalendar({
                // Configuración del calendario
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                events: convertCitasToEvents(citas) // Eventos del calendario
            });
        }

        // Manejar el envío del formulario de agregar cita
        $('#addCitaForm').on('submit', function(event) {
            event.preventDefault();
            const formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                success: function(response) {
                    // Recargar la lista de citas
                    fetchCitas().then(data => {
                        $('#calendar').fullCalendar('removeEvents');
                        $('#calendar').fullCalendar('addEventSource', convertCitasToEvents(data));
                    });

                    // Cerrar el modal de agregar cita
                    $('#addCitaModal').modal('hide');

                    // Limpiar el formulario después de guardar
                    $('#addCitaForm')[0].reset();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });

        // Inicializar Flatpickr u otro calendario para seleccionar fechas
        flatpickr('#fecha', {
            enableTime: false,
            dateFormat: 'Y-m-d',
        });

        // Llamar a fetchCitas inicialmente para cargar las citas
        fetchCitas().then(data => {
            initializeCalendar(data); // Si usas calendario
        });
    });
</script>

</body>
</html>
