<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Inscripciones</title>
    <style>
         body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 30px;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-bottom: 20px;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #c7faec;
        }

        th, td {
            border: 1px solid #4efc99;
            padding: 8px;
            text-align: left;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Reporte de Inscripciones</h1>
     <p>
        Desde: {{ \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') }} &nbsp;
        Hasta: {{ \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') }}
    </p>

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
</body>
</html>


