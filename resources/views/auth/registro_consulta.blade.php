<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Consultas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
        .card {
            margin-bottom: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Datos paciente
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
    </div>

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
