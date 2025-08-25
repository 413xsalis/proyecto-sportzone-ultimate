<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        header {
            text-align: center;
            padding: 10px 0;
            border-bottom: 2px solid #333;
        }

        header img {
            width: 80px;
            height: auto;
            margin-bottom: 5px;
        }

        h2 {
            margin: 5px 0;
        }

        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 40px;
            text-align: center;
            font-size: 10px;
            border-top: 1px solid #a00707;
            padding-top: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #a00707;
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .resumen {
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<header>
    <img src="{{ public_path('assets/images/logo_escuela.png') }}" alt="Logo Escuela">
    <h2>Escuela Deportiva Safuka</h2>
    <p><strong>Reporte de Pagos</strong></p>
    <p>Desde {{ $inicio }} hasta {{ $fin }}</p>
</header>

<main>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Estudiante</th>
                <th>Tipo</th>
                <th>Valor</th>
                <th>Fecha de Pago</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
                <tr>
                    <td>{{ $pago->id }}</td>
                    <td>
                        {{ $pago->estudiante->nombre_1 ?? '' }}
                        {{ $pago->estudiante->apellido_1 ?? '' }}
                    </td>
                    <td>{{ ucfirst($pago->tipo) }}</td>
                    <td>${{ number_format($pago->valor, 0, ',', '.') }}</td>
                    <td>{{ $pago->fecha_pago }}</td>
                    <td>{{ ucfirst($pago->estado) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="resumen">Total Pagos: {{ count($pagos) }}</p>
</main>

<footer>
    © {{ date('Y') }} Escuela Deportiva Safuka | Generado el {{ date('d/m/Y H:i') }}
</footer>

</body>
</html>
