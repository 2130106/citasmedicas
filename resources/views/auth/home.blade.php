<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #495057;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 250px;
            background-color: #ffffff;
            color: black;
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
            color: white;
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
            width: 100%;
            max-width: 300px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }
        .search-bar input:focus {
            outline: none;
            border-color: #6c757d;
        }
        .main-content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .calendar-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 50px;
        }
        #calendar {
            width: 450px;
            height: 600px;
            padding: 10px;
            border-radius: 15px;
            margin-left: 10px;
        }
        #agenda {
            flex: 1;
            margin-left: 30px;
        }
        .add-button {
            
            margin-bottom: 20px; 
        }

        .btn-custom {
        background-color: #9370DB; 
        color: #ffffff; 
        border-color: #5e2056; 
    }
    .btn-custom:hover {
        background-color: #53189f; 
        border-color: #402959; 
    }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="user-info text-center p-3">
            <img src="{{ asset('img/logoconsultorio.jpeg') }}" alt="User Image">
            <span>{{ Auth::user()->name }}</span>
        </div>
        <a href="{{ route('home') }}">Agenda</a>
        <a href="{{ route('citas.index') }}">Citas</a>
        <a href="{{ route('pacientes.index') }}">Pacientes</a>
        <a href="{{ route('medicos.index') }}">Médicos</a>
        <a href="{{ route('pacientes.index') }}">Pacientes</a>
    </div>

    <div class="content">
        <div class="header">
            <div class="search-bar">
                <input type="text" placeholder="Buscar...">
            </div>
            <div class="user-info">
                <img src="{{ asset('img/logoconsultorio.jpeg') }}" alt="User Image">
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link text-white">Cerrar Sesión</button>
                </form>
            </div>
        </div>
        <div class="main-content">
            <h1 class="mb-4">Bienvenido, {{ Auth::user()->name }}</h1>

            <div class="add-button">
                <button class="btn btn-custom" data-toggle="modal" data-target="#addCitaModal">Agregar Cita</button>
            </div>

            <div class="calendar-container">
                <div id="calendar"></div>
                <div id="agenda"></div>
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
                                    <option value="{{ $paciente->nombre }}">{{ $paciente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="medico">Médico</label>
                            <select id="medico" name="medico" class="form-control" required>
                                <option value="">Seleccione un médico</option>
                                @foreach ($medicos as $medico)
                                    <option value="{{ $medico->id }}" data-consultorio="{{ $medico->consultorio }}">{{ $medico->nombre }} {{ $medico->apellido }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group">
                            <label for="consultorio">Consultorio</label>
                            <input type="text" id="consultorio" name="consultorio" class="form-control" readonly>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            function fetchCitas() {
                return $.ajax({
                    url: "{{ route('citas.index') }}",
                    method: 'GET',
                    dataType: 'json'
                });
            }

            function convertCitasToEvents(citas) {
                return citas.map(cita => ({
                    title: cita.paciente,
                    start: cita.fecha + 'T' + cita.hora,
                    description: cita.medico + ' - ' + cita.consultorio,
                    status: cita.estado
                }));
            }

            function initializeCalendar(citas) {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'prev,next',
                        center: 'title',
                        right: 'month,listMonth'
                    },
                    editable: true,
                    locale: 'es',
                    events: convertCitasToEvents(citas),
                    displayEventTime: true,
                    buttonText: {
                        month: 'Mes',
                        listMonth: 'citas'
                    },
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb']
                });

                
                
                $('#agenda').fullCalendar({
                    header: {
                        right: 'agendaWeek,agendaDay'
                    },
                    editable: true,
                    locale: 'es',
                    events: convertCitasToEvents(citas),
                    buttonText: {
                        today: 'Hoy',
                        week: 'Semana',
                        day: 'Día'
                    },
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb']
                });
            }

            fetchCitas().then(data => {
                initializeCalendar(data);
            });
            flatpickr('#fecha', {
                enableTime: false,
                dateFormat: 'Y-m-d',
            });

            $('#addCitaForm').on('submit', function(event) {
                event.preventDefault();
                const formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    success: function(response) {
                        fetchCitas().then(data => {
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('addEventSource', convertCitasToEvents(data));
                            $('#agenda').fullCalendar('removeEvents');
                            $('#agenda').fullCalendar('addEventSource', convertCitasToEvents(data));
                        });

                        $('#addCitaModal').modal('hide');
                        $('#addCitaForm')[0].reset();
                    }
                });
            });
            flatpickr('#fecha', {
                enableTime: false,
                dateFormat: 'Y-m-d',
            });
            $('#medico').on('change', function() {
                    var selectedMedico = $(this).find('option:selected');
                    var consultorio = selectedMedico.data('consultorio');
                    $('#consultorio').val(consultorio);
                });
        });
    </script>
</body>
</html>
