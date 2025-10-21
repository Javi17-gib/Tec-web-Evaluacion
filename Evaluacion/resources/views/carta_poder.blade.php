<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carta Poder</title>
    <style>
        body { font-family: sans-serif; }
        .header { text-align: center; margin-bottom: 20px; }
        .contenido { margin-top: 20px; }
        .qr { position: absolute; top: 20px; right: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Carta Poder</h2>
    </div>
    <div class="contenido">
        <p>Se asigna el dispositivo <strong>{{ $asignacion->dispositivo->nombre }}</strong> ({{ $asignacion->dispositivo->serial }}) al usuario <strong>{{ $asignacion->usuario->name }}</strong>.</p>
        <p>Fecha de asignación: {{ $asignacion->fecha_asignacion }}</p>
    </div>
    <div class="qr">
        <img src="{{ public_path($qr) }}" width="100">
    </div>
</body>
</html>
