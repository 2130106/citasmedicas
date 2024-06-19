<!-- home.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
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
            <!-- Contenido principal de la página -->
            <h1 class="mb-4">Bienvenido, {{ Auth::user()->name }}</h1>

            <!-- Tabla de Citas -->
            <div class="mb-4">
                <h3>Citas</h3>
                <table class="table">
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
                        <tr>
                            <td>1</td>
                            <td>11/02/2003</td>
                            <td>11:00 </td>
                            <td>mario</td>
                            <td> Dr.said</td>
                            <td>5</td>
                            <td>Activo</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>

            <!-- Formulario para Crear Cita -->
            <div>
                <h3>Agregar Cita</h3>
                <form method="POST" action="{{ route('citas.store') }}">
                    @csrf
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input id="fecha" type="text" class="form-control" name="fecha" placeholder="Selecciona la fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="hora">Hora:</label>
                        <input id="hora" type="text" class="form-control" name="hora" placeholder="Ej. 10:00 AM" required>
                    </div>
                    <div class="form-group">
                        <label for="paciente">Paciente:</label>
                        <input id="paciente" type="text" class="form-control" name="paciente" required>
                    </div>
                    <div class="form-group">
                        <label for="medico">Médico:</label>
                        <input id="medico" type="text" class="form-control" name="medico" required>
                    </div>
                    <div class="form-group">
                        <label for="consultorio">Consultorio:</label>
                        <input id="consultorio" type="text" class="form-control" name="consultorio" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado:</label>
                        <select id="estado" class="form-control" name="estado" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="cancelada">Cancelada</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Cita</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#fecha', {
            enableTime: false,
            dateFormat: 'Y-m-d',
        });
    </script>
</body>
</html>
