<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Carta Poder</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 40px;
            font-size: 14px;
            line-height: 1.6;
        }
        h1, h2, h3 {
            text-align: center;
        }
        .contenedor {
            border: 1px solid #000;
            padding: 20px;
        }
        .qr {
            text-align: center;
            margin-top: 20px;
        }
        .firma {
            margin-top: 60px;
            text-align: center;
        }
        .firma div {
            display: inline-block;
            width: 40%;
            border-top: 1px solid #000;
            margin: 0 20px;
            padding-top: 5px;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h1>CARTA PODER</h1>
        <p>Yo, <strong>{{ $asignacion->usuario->nombre ?? $asignacion->usuario->name }}</strong>, por medio de la presente otorgo poder al área de sistemas para hacer uso temporal del siguiente dispositivo:</p>

        <ul>
            <li><strong>Dispositivo:</strong> {{ $asignacion->dispositivo->tipo ?? 'N/A' }}</li>
            <li><strong>Motivo:</strong> {{ $asignacion->motivo ?? 'Sin especificar' }}</li>
            <li><strong>Fecha de Asignación:</strong> {{ $asignacion->fecha_asignacion }}</li>
        </ul>

        <p>El dispositivo será devuelto en las mismas condiciones al finalizar su uso o cuando sea requerido.</p>

        <div class="qr">
            <img src="data:image/svg+xml;base64,{{ $qr }}" width="150">
            <p><small>Código de verificación</small></p>
        </div>

        <div class="firma">
            <div>{{ $asignacion->responsable_entrega ?? '____________________' }}<br>Entrega</div>
            <div>{{ $asignacion->responsable_recibe ?? '____________________' }}<br>Recibe</div>
        </div>
    </div>
</body>
</html>
