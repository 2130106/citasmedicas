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
        .hidden {
            display: none;
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
            <a href="{{ route('consultas.index') }}">Registro de consultas</a> 
        @endif
    </div>

    <div class="content">
        <div class="header">
            <div class="user-info">
                <img src="{{ asset('img/logoconsultorio.jpeg') }}" alt="User Image">
                <button class="btn btn-link" id="user-info-btn">{{ Auth::user()->name }}</button>

                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link text-white">Cerrar Sesión</button>
                </form>
            </div>
        </div>
        <div class="main-content">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <h1 class="mb-4">Registro de Consultas</h1>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('consultas.store') }}">
                        @csrf
                        <input type="hidden" name="cita_id" value="{{ $cita->id }}">
                        
                        <div class="card-header bg-info text-white mt-4">
                            Historial clínico
                        </div>
                        <div class="form-group mt-4">
                            <label for="alergias">¿Tiene alergias?</label>
                            <select class="form-control" id="alergias" name="alergias" onchange="toggleField('alergias', 'alergias_detalle')" required>
                                <option value="no" {{ isset($consulta) && $consulta->alergias == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($consulta) && $consulta->alergias == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                        <div class="form-group hidden" id="alergias_detalle">
                            <label for="alergias_texto">Detalle de alergias</label>
                            <textarea class="form-control" id="alergias_texto" name="alergias_texto" placeholder="Detalle de alergias">{{ $consulta->alergias_texto ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="enfermedades">¿Tiene enfermedades?</label>
                            <select class="form-control" id="enfermedades" name="enfermedades" onchange="toggleField('enfermedades', 'enfermedades_detalle')" required>
                                <option value="no" {{ isset($consulta) && $consulta->enfermedades == 'no' ? 'selected' : '' }}>No</option>
                                <option value="si" {{ isset($consulta) && $consulta->enfermedades == 'si' ? 'selected' : '' }}>Sí</option>
                            </select>
                        </div>
                        <div class="form-group hidden" id="enfermedades_detalle">
                            <label for="enfermedades_texto">Detalle de enfermedades</label>
                            <textarea class="form-control" id="enfermedades_texto" name="enfermedades_texto" placeholder="Detalle de enfermedades">{{ $consulta->enfermedades_texto ?? '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="estatura">Estatura (cm)</label>
                            <input type="number" class="form-control" id="estatura" name="estatura" placeholder="Estatura en cm" step="0.1" value="{{ $consulta->estatura ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="peso">Peso (kg)</label>
                            <input type="number" class="form-control" id="peso" name="peso" placeholder="Peso en kg" step="0.1" value="{{ $consulta->peso ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="temperatura">Temperatura (°C)</label>
                            <input type="number" class="form-control" id="temperatura" name="temperatura" placeholder="Temperatura en °C" step="0.1" value="{{ $consulta->temperatura ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="motivo_consulta">Motivo de la consulta</label>
                            <textarea class="form-control" id="motivo_consulta" name="motivo_consulta" placeholder="Motivo de la consulta">{{ $consulta->motivo_consulta ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="notas">Notas adicionales</label>
                            <textarea class="form-control" id="notas" name="notas" placeholder="Notas adicionales">{{ $consulta->notas ?? '' }}</textarea>
                        </div>
                        
                        <!-- Nueva Sección: Selección de Servicios -->
                        <div class="card-header bg-secondary text-white mt-4">
                            Servicios
                        </div>
                        <div class="form-group mt-4">
                            <label>Selecciona los servicios:</label>
                            @foreach($servicios as $servicio)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="servicio_{{ $servicio->id }}" name="servicios[]" value="{{ $servicio->id }}" data-precio="{{ $servicio->precio }}"
                                       {{ isset($consulta) && $consulta->servicios->contains('id', $servicio->id) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="servicio_{{ $servicio->id }}">
                                        {{ $servicio->nombre }} - ${{ $servicio->precio }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="total">Total</label>
                            <input type="text" class="form-control" id="total" name="total" placeholder="0.0" readonly value="{{ $consulta->total ?? '0.0' }}">
                        </div>
                        
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                        <a href="{{ route('consultas.download', ['id' => $consulta->id]) }}" class="btn btn-primary">Descargar PDF</a>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para mostrar/ocultar campos basados en la selección
        function toggleField(selectId, fieldId) {
            const selectElement = document.getElementById(selectId);
            const fieldElement = document.getElementById(fieldId);
            if (selectElement.value === 'si') {
                fieldElement.classList.remove('hidden');
            } else {
                fieldElement.classList.add('hidden');
            }
        }

        // Inicializa el estado de los campos basados en el valor actual
        document.addEventListener('DOMContentLoaded', function() {
            toggleField('alergias', 'alergias_detalle');
            toggleField('enfermedades', 'enfermedades_detalle');
        });

        // Actualiza el total basado en los servicios seleccionados
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('form-check-input')) {
                const checkboxes = document.querySelectorAll('.form-check-input:checked');
                let total = 0;
                checkboxes.forEach(checkbox => {
                    total += parseFloat(checkbox.getAttribute('data-precio'));
                });
                document.getElementById('total').value = total.toFixed(2);
            }
        });
    </script>
</body>
</html>
