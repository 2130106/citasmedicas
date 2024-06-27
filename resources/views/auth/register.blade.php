<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .card-wrapper {
            background-color: #d3d3d3;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card {
            display: flex;
            flex-direction: row;
            width: 700px;
            border-radius: 10px;
            background-color: #ffffff;
            max-height: 90vh; 
            overflow: hidden; 
        }
        .card-body {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            font-size: 14px;
            overflow-y: auto; 
        }
        .image {
            flex: 1;
            background: url('/img/logoconsultorio.jpeg') no-repeat center center;
            background-size: cover;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            border-left: 2px solid #9370DB;
            box-shadow: 0 4px 8px rgba(147, 112, 219, 0.5);
        }
        .bg-lila {
            background-color: #9370DB;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 15px;
            color: white;
            font-size: 20px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .card-header {
            font-size: 20px;
            text-align: center;
        }
        .btn-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="email"], input[type="password"] {
            border-radius: 5px;
        }
        select {
            border-radius: 5px;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
        }
        .btn-group .btn {
            flex: 1;
            margin: 0 5px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="card-wrapper">
        <div class="card">
            <div class="card-body">
                <div class="card-header bg-lila">Registro</div>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <div class="form-row">
                            <input type="text" class="form-control col mr-1" id="apellido1" name="apellido1" placeholder="Apellido Paterno" required>
                            <input type="text" class="form-control col" id="apellido2" name="apellido2" placeholder="Apellido Materno" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="sexo">Sexo</label>
                            <select class="form-control" id="sexo" name="sexo" required>
                                <option value="0">Hombre</option>
                                <option value="1">Mujer</option>
                                <option value="2">No prefiero especificar</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="role">Tipo de usuario</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="doctor">Doctor</option>
                                <option value="secretaria">Secretaria</option>
                            </select>
                        </div>
                    </div>
                    <div id="doctorFields" class="hidden">
                        <div class="form-group">
                            <label for="especialidad">Especialidad</label>
                            <input type="text" class="form-control" id="especialidad" name="especialidad">
                        </div>
                        <div class="form-group">
                            <label for="consultorio">Consultorio</label>
                            <input type="text" class="form-control" id="consultorio" name="consultorio">
                        </div>
                    </div>
                    <div class="btn-group">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                        <a href="{{ route('login') }}" class="btn btn-secondary">Iniciar sesión</a>
                    </div>
                </form>
            </div>
            <div class="image"></div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const doctorFields = document.getElementById('doctorFields');

            roleSelect.addEventListener('change', function() {
                if (this.value === 'doctor') {
                    doctorFields.classList.remove('hidden');
                } else {
                    doctorFields.classList.add('hidden');
                }
            });

            // For initial load
            if (roleSelect.value === 'doctor') {
                doctorFields.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
