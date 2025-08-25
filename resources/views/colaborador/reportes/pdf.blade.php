<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Inscripciones</title>
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

        .resumen {
            margin-top: 20px;
            font-weight: bold;
            text-align: right;
        }
    </style>
</head>
<body>

    <header>
        <img src="{{ public_path('assets/images/logo_escuela.png') }}" alt="Logo">
        <h2>Escuela Safuka</h2>
        <h2>Reporte de Inscripciones</h2>   
     <p>
        Desde: {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} &nbsp;
        Hasta: {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
    </p>
    </header>


<main>
    <table>
        <thead>
            <tr>
                <th>Documento</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Fecha de Registro</th>
            </tr>
        </thead>
        <tbody>
            @forelse($estudiantes as $estudiante)
            <tr>
                <td>{{ $estudiante->documento }}</td>
                <td>{{ $estudiante->nombre_1 }} {{ $estudiante->apellido_1 }}</td>
                <td>{{ $estudiante->telefono }}</td>
                <td>{{ $estudiante->created_at->format('Y-m-d') }}</td>
            </tr>
            @empty
        <tr>
        <td colspan="4" style="text-align: center;">No hay estudiantes registrados en este rango de fechas.</td>
        </tr>
            @endforelse
        </tbody>
    </table>
</main>
<footer>
    © {{ date('Y') }} Escuela Deportiva Safuka | Generado el {{ date('d/m/Y H:i') }}
</footer>

</body>
</html>


