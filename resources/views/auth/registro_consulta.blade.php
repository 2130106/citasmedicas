<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Consultas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        .form-control {
            margin-bottom: 10px;
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
            <h1 class="mb-4">Registro de Consultas</h1>
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Datos del paciente
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('consultas.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="nombre">Nombre(s)</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre(s)" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido_paterno">Apellido Paterno</label>
                            <input type="text" class="form-control" id="apellido_paterno" name="apellido_paterno" placeholder="Apellido Paterno" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido_materno">Apellido Materno</label>
                            <input type="text" class="form-control" id="apellido_materno" name="apellido_materno" placeholder="Apellido Materno">
                        </div>
                        <div class="form-group">
                            <label for="fecha_nacimiento">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" required>
                        </div>
                        <div class="form-group">
                            <label for="edad">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" placeholder="Edad" required>
                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <select class="form-control" id="sexo" name="sexo" required>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                        </div>
                        <div class="card-header bg-info text-white mt-4">
                            Historial clínico
                        </div>
                        <div class="form-group mt-4">
                            <label for="alergias">¿Tiene alergias?</label>
                            <select class="form-control" id="alergias" name="alergias" onchange="toggleField('alergias', 'alergias_detalle')" required>
                                <option value="no">No</option>
                                <option value="si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group hidden" id="alergias_detalle">
                            <label for="alergias_texto">Detalle de alergias</label>
                            <textarea class="form-control" id="alergias_texto" name="alergias_texto" placeholder="Detalle de alergias"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="enfermedades">¿Tiene enfermedades?</label>
                            <select class="form-control" id="enfermedades" name="enfermedades" onchange="toggleField('enfermedades', 'enfermedades_detalle')" required>
                                <option value="no">No</option>
                                <option value="si">Sí</option>
                            </select>
                        </div>
                        <div class="form-group hidden" id="enfermedades_detalle">
                            <label for="enfermedades_texto">Detalle de enfermedades</label>
                            <textarea class="form-control" id="enfermedades_texto" name="enfermedades_texto" placeholder="Detalle de enfermedades"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Registrar Consulta</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleField(selectId, fieldId) {
            var select = document.getElementById(selectId);
            var field = document.getElementById(fieldId);
            if (select.value === 'si') {
                field.classList.remove('hidden');
            } else {
                field.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
