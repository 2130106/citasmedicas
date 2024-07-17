<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            margin-bottom: 10px;
        }
        #calendar {
        width: 300px;
        height: 283px;
        padding: 10px;
        }
        #calendar .fc-today-button{
            display: none;
        }

        #lista .fc-toolbar-chunk:first-child,#lista .fc-toolbar-chunk:nth-child(3){
            display: none;
        }

        .fc-daygrid-day-frame {
            height: 33px !important; 
            padding: 1px; 
        }
      
        .fc-daygrid-day-number {
            font-size: 12px;
            color: #bd31d2;
        }
        .fc-col-header-cell-cushion {
            color: #8b209b;
        }

        #agenda {
            flex: 1;
            margin-left: 30px;
            width: 300px;
            height: 600px;
            padding: 5px;
        }

    .fc-time-grid .fc-slats td,
    .fc-time-grid .fc-axis {
        height: 30px !important; 
    }

    .fc-time-grid .fc-content-col {
        min-height: 30px; 
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
            <button class="btn btn-link" id="user-info-btn">{{ Auth::user()->name }}</button>
        </div>
        <a href="{{ route('home') }}">Agenda</a>
        <a href="{{ route('citas.index') }}">Citas</a>
        <a href="{{ route('pacientes.index') }}">Pacientes</a>
        @if (Auth::user()->role=='admin')
            <a href="{{ route('medicos.index') }}">Médicos</a> 
        @endif
        <a href="#">Servicios</a>
        @if (Auth::user()->role=='doctor')
            <a href="{{ route('consultas.index') }}">Registro de consultas. </a> 
        @endif
        @if (Auth::user()->role=='admin')
            <a href="{{ route('consultas.index') }}">Registro de consultas. </a> 
        @endif
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
            <button class="btn btn-primary" data-toggle="modal" data-target="#addCitaModal">Agregar Cita</button>
            </div>

            <div class="calendar-container">
                <div>
                <div id="calendar"></div>
                <div id="lista"></div>
                </div>
                <div id="agenda"></div>
                

            </div>
            <!-- Modal para mostrar detalles de la cita -->
        <div class="modal fade" id="citaDetailsModal" tabindex="-1" role="dialog" aria-labelledby="citaDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="citaDetailsModalLabel">Detalles de la Cita</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="citaDetailsBody">
                        <!-- Aquí se llenarán dinámicamente los detalles de la cita -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
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
                                    <option value="{{ $paciente->nombre }}">{{ $paciente->nombre }} {{ $paciente->apellido }}</option>
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
                                <option value="2">Pendiente</option>
                                <option value="1">Confirmada</option>
                                <option value="3">Cancelada</option>
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

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.14/index.global.min.js" integrity="sha512-JEbmnyttAbEkbkpvW1vRqBzY3Otrp0DFwux9+JQ6kXe2mQfUmBpImuREMZS0advTaaCMotaYB5gIng/uPw3r6w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        document.getElementById('user-info-btn').addEventListener('click', function() {
            window.location.href = "{{ route('user.edit') }}";
        });

        $(document).ready(function() {
            function fetchCitas() {
                return $.ajax({
                    url: "{{ route('citas.index') }}",
                    method: 'GET',
                    dataType: 'json'
                });
            }

            function convertCitasToEvents(citas) {
                const estadoMap = {
                    2: 'Pendiente',
                    3: 'Cancelada',
                    1: 'Confirmada',
                };

                return citas.map(cita => ({
                    title: cita.paciente + ' Estado: ' + estadoMap[cita.estado],
                    start: cita.fecha + 'T' + cita.hora,
                    description: estadoMap[cita.estado],
                    status: estadoMap[cita.estado],
                   
                }));
            }

            function initializeCalendar(citas) {
                var calE=document.querySelector('#calendar')
                var cal= new FullCalendar.Calendar(calE,{
                    initialView: 'dayGridMonth',
                    header: {
                        left: 'prev,next ',
                        center: 'title',
                        right: 'month,listMonth'
                    },
                    editable: true,
                    locale: 'es',
                    displayEventTime: true,
                    buttonText: {
                        month: 'Mes',
                        listMonth: 'Lista'
                    },
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                    eventClick: function(event) {
                    $('#citaDetailsBody').html(
                        `<p><strong>Paciente:</strong> ${event.event.title}</p>` +
                        `<p><strong>Médico:</strong> ${event.event.extendedProps.medico}</p>` 
                    );
                    $('#citaDetailsModal').modal();
                }
                    
                });
                cal.render();

                var lisE=document.querySelector('#lista')
                var lis= new FullCalendar.Calendar(lisE,{
                    initialView: 'listWeek',
                    header: {
                        left: 'prev,next ',
                        center: 'title',
                        right: 'month,listMonth'
                    },
                    editable: true,
                    locale: 'es',
                    displayEventTime: true,
                    events: convertCitasToEvents(citas),
                    buttonText: {
                        month: 'Mes',
                        listMonth: 'Lista'
                    },
                    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                    eventClick: function(event) {
                        $('#citaDetailsBody').html(
                            `<p><strong>Paciente:</strong> ${event.event.title}</p>` +
                            `<p><strong>Médico:</strong> ${event.event.description}</p>` +
                            `<p><strong>Estado:</strong> ${event.event.status}</p>`
                        );
                        $('#citaDetailsModal').modal();
                    }
                });
                lis.render();


                // Configuración para la agenda semanal y diaria
                var agenE=document.querySelector('#agenda')
                var agen= new FullCalendar.Calendar(agenE,{
                    initialView: 'timeGridWeek',
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
                    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
                    eventClick: function(event) {
                        $('#citaDetailsBody').html(
                            `<p><strong>Paciente:</strong> ${event.event.title}</p>` +
                            `<p><strong>Médico:</strong> ${event.description}</p>` +
                            `<p><strong>Estado:</strong> ${event.status}</p>`
                        );
                        $('#citaDetailsModal').modal();
                    }
                });
                agen.render();
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

            $('#medico').on('change', function() {
                var selectedMedico = $(this).find('option:selected');
                var consultorio = selectedMedico.data('consultorio');
                $('#consultorio').val(consultorio);
            });
        });
    </script>
    
</body>
</html>
