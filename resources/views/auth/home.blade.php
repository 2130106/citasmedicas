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
        }
        #calendar {
            width: 250px; /* Ancho fijo del calendario */
            height: 50px;
            padding: 20px; /* Espaciado interno del calendario */
            border-radius: 15px; /* Bordes redondeados */
        }
        #agenda {
            width: 100%;
            margin-left: 20px;
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
        <a href="#">Médicos</a>
        <a href="#">Usuarios</a>
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

            <!-- Contenedor de calendarios -->
            <div class="calendar-container">
                <!-- Calendario de fechas -->
                <div id="calendar"></div>

                <!-- Calendario de agenda -->
                <div id="agenda"></div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function() {
            // Cargar citas desde el servidor
            function fetchCitas() {
                return $.ajax({
                    url: "{{ route('citas.index') }}",
                    method: 'GET',
                    dataType: 'json'
                });
            }

            // Convertir citas a eventos para el calendario
            function convertCitasToEvents(citas) {
                return citas.map(cita => ({
                    title: cita.paciente,
                    start: cita.fecha + 'T' + cita.hora,
                    description: cita.medico + ' - ' + cita.consultorio,
                    status: cita.estado
                }));
            }

            // Inicializar el calendario
            function initializeCalendar(citas) {
                $('#agenda').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
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

            // Fetch citas and initialize calendar
            fetchCitas().then(data => {
                initializeCalendar(data);
            });

            flatpickr('#calendar', {
                inline: true,
                enableTime: false,
                dateFormat: 'Y-m-d',
            });
        });
    </script>
</body>
</html>
