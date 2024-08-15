<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Consultas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 8px;
            width: 100%;
        }
        .form-check-label {
            margin-left: 5px;
        }
    </style>
</head>
<body>
    <h1>Registro de Consultas</h1>
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
    <div class="form-group">
        <label for="total">Total</label>
        <p>${{ $consulta->total }}</p>
    </div>
</body>
</html>
