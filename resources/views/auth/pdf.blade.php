<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta PDF</title>
</head>
<body>
    <h1>Detalles de la Consulta</h1>
    <p><strong>Nombre:</strong> {{ $consulta->nombre }}</p>
    <p><strong>Apellido Paterno:</strong> {{ $consulta->apellido_paterno }}</p>
    <p><strong>Apellido Materno:</strong> {{ $consulta->apellido_materno }}</p>
    <p><strong>Fecha de Nacimiento:</strong> {{ $consulta->fecha_nacimiento }}</p>
    <p><strong>Edad:</strong> {{ $consulta->edad }}</p>
    <p><strong>Sexo:</strong> {{ $consulta->sexo }}</p>
    <p><strong>Alergias:</strong> {{ $consulta->alergias }}</p>
    @if($consulta->alergias == 'si')
        <p><strong>Detalles de Alergias:</strong> {{ $consulta->alergias_texto }}</p>
    @endif
    <p><strong>Enfermedades:</strong> {{ $consulta->enfermedades }}</p>
    @if($consulta->enfermedades == 'si')
        <p><strong>Detalles de Enfermedades:</strong> {{ $consulta->enfermedades_texto }}</p>
    @endif
</body>
</html>
