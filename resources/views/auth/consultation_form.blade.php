<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Consultas</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }
        .container {
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            padding: 30px;
            background: #fff;
            border-radius: 8px;
            border: 1px solid #bd31d2;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            color: #333;
            font-size: 1.8em;
        }
        .section {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fafafa;
        }
        .section h2 {
            margin-top: 0;
            font-size: 1.4em;
            color: #333;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .section label {
            display: block;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }
        .section p {
            margin: 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #fff;
        }
        .section ul {
            list-style-type: none;
            padding: 0;
        }
        .section ul li {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .section ul li:last-child {
            border-bottom: none;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 10px;
            border-top: 2px solid #000;
            color: #333;
        }
        .total {
            font-weight: bold;
            font-size: 1.2em;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Registro de Consultas</h1>
        </div>
        
        <div class="section">
            <h2>Datos del Paciente</h2>
            <div class="form-group">
                <label for="paciente">Nombre</label>
                <p>{{ $paciente->name }} {{ $paciente->apellido }}</p>
            </div>
            <div class="form-group">
                <label for="edad">Edad</label>
                <p>{{ $paciente->edad }}</p>
            </div>
        </div>

        <div class="section">
            <h2>Datos del Doctor</h2>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <p>{{ $medico->name }}</p>
            </div>
            <div class="form-group">
                <label for="apellido">Apellido</label>
                <p>{{ $medico->apellido1 }} {{ $medico->apellido2 }}</p>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <p>{{ $medico->email }}</p>
            </div>
        </div>
        <div class="section">
            <h2>Detalles de la Consulta</h2>
            <div class="form-group">
                <label for="alergias">¿Tiene alergias?</label>
                <p>{{ $consulta->alergias == 'si' ? 'Sí' : 'No' }}</p>
                @if ($consulta->alergias == 'si')
                    <label>Detalle de alergias</label>
                    <p>{{ $consulta->alergias_texto }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="enfermedades">¿Tiene enfermedades?</label>
                <p>{{ $consulta->enfermedades == 'si' ? 'Sí' : 'No' }}</p>
                @if ($consulta->enfermedades == 'si')
                    <label>Detalle de enfermedades</label>
                    <p>{{ $consulta->enfermedades_texto }}</p>
                @endif
            </div>
            <div class="form-group">
                <label for="estatura">Estatura (cm)</label>
                <p>{{ $consulta->estatura }}</p>
            </div>
            <div class="form-group">
                <label for="peso">Peso (kg)</label>
                <p>{{ $consulta->peso }}</p>
            </div>
            <div class="form-group">
                <label for="temperatura">Temperatura (°C)</label>
                <p>{{ $consulta->temperatura }}</p>
            </div>
            <div class="form-group">
                <label for="motivo_consulta">Motivo de la consulta</label>
                <p>{{ $consulta->motivo_consulta }}</p>
            </div>
            <div class="form-group">
                <label for="notas">Notas adicionales</label>
                <p>{{ $consulta->notas }}</p>
            </div>
            <div class="form-group">
                <label for="servicios">Servicios:</label>
                <ul>
                    @foreach($servicios as $servicio)
                        @if($consulta->servicios->contains('id', $servicio->id))
                            <li>{{ $servicio->nombre }} - ${{ $servicio->precio }}</li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="form-group total">
                <label for="total">Total</label>
                <p>${{ $consulta->total }}</p>
            </div>
        </div>

        <div class="footer">
            <p>Este documento es confidencial y está destinado solo para uso interno.</p>
        </div>
    </div>
</body>
</html>
