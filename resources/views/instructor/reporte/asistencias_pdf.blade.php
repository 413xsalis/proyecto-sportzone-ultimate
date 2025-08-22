<!DOCTYPE html>
<html>

<head>
    <title>Reporte de Asistencias</title>
    <style>
        body {
            font-family: 'Times New Roman', sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .header {
            margin-bottom: 30px;
        }

        .report-title {
            font-size: 24px;
            text-align: center;
            margin-bottom: 15px;
        }

        .info-column {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .info-label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="report-title">Reporte de Asistencias</div>
        @if($asistencias->isNotEmpty())
        <div style="float: left;">
            <div class="info-column"><span class="info-label">Grupo:</span> {{ $asistencias->first()->subgrupo->grupo->nombre ?? 'N/A' }}</div>
            <div class="info-column"><span class="info-label">Subgrupo:</span> {{ substr($asistencias->first()->subgrupo->nombre ?? 'N/A', -1) }}</div>
            <div class="info-column"><span class="info-label">Fecha de Generacion:</span> {{ $fechaGeneracion }}</div>
        </div>
        <div style="clear: both;"></div>
        @endif
    </div>
    <table>
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Documento</th>
                <th>Grupo</th>
                <th>Subgrupo</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($asistencias as $asis)
            <tr>
                <td>{{ $asis->estudiante->nombre_completo ?? 'N/A' }}</td>
                <td>{{ $asis->estudiante->documento ?? 'N/A' }}</td>
                <td>{{ $asis->subgrupo->grupo->nombre ?? 'N/A' }}</td>
                <td>{{ substr($asis->subgrupo->nombre ?? 'N/A', -1) }}</td>
                <td>{{ $asis->fecha }}</td>
                <td>{{ $asis->estado }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6">No hay registros de asistencia para mostrar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>

</html>