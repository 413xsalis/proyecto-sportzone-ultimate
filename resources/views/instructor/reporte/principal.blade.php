@extends('instructor.reporte.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


@section('content')

<main class="app-content">
  <div class="container mt-5">
    <h4 class="mb-4 text-center fw-bold text-primary">Reporte de Asistencias</h4>

    {{-- Formulario de filtrado --}}
    <form method="GET" action="{{ route('inst.reporte') }}" class="row g-3 mb-4">
      <div class="col-md-4">
        <label for="subgrupo" class="form-label">Filtrar por Subgrupo</label>
        <select name="subgrupo" id="subgrupo" class="form-select" required>
          <option value="">Seleccione...</option>
          @foreach($subgrupos as $sub)
          <option value="{{ $sub->id }}" {{ request('subgrupo') == $sub->id ? 'selected' : '' }}>
            {{ $sub->nombre }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-info w-100">Filtrar</button>
      </div>
    </form>

    {{-- Tabla de datos --}}
    <div class="table-responsive">
      <table id="tabla-asistencias" class="table table-bordered table-hover text-center align-middle">
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
            <td>
              <span class="badge {{ $asis->estado == 'Presente' ? 'bg-success' : 'bg-danger' }}">
                {{ $asis->estado }}
              </span>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6">No hay registros de asistencia para mostrar.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="d-flex justify-content-end mb-3">
      <button type="button" class="btn btn-primary" onclick="generarReportePDF()">
        Exportar PDF
      </button>
    </div>

  </div>
  <script>
    // La función generarReportePDF() que te pasé antes va aquí sin ningún cambio.
    function generarReportePDF() {
      const tabla = document.getElementById('tabla-asistencias');
      const filas = tabla.getElementsByTagName('tr');
      if (filas.length <= 1) {
        alert("No hay datos para generar un reporte.");
        return;
      }
      const {
        jsPDF
      } = window.jspdf;
      const doc = new jsPDF('p', 'mm', 'a4');
      const titulo = "Reporte de Asistencias";
      const fecha = new Date().toLocaleDateString('es-CO', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
      });
      const selectSubgrupo = document.getElementById('subgrupo');
      const subgrupoSeleccionado = selectSubgrupo.options[selectSubgrupo.selectedIndex].text;
      doc.setFontSize(18);
      doc.text(titulo, 14, 22);
      doc.setFontSize(11);
      doc.setTextColor(100);
      if (selectSubgrupo.value) {
        doc.text(`Subgrupo: ${subgrupoSeleccionado}`, 14, 30);
      }
      doc.text(`Fecha de generación: ${fecha}`, 14, 35);
      doc.autoTable({
        html: '#tabla-asistencias',
        startY: 40,
        theme: 'grid',
        headStyles: {
          fillColor: [13, 110, 253],
          textColor: 255,
          fontStyle: 'bold'
        },
        didDrawCell: (data) => {
          if (data.section === 'body' && data.column.index === 4) {
            const texto = data.cell.text[0].trim().toLowerCase();
            if (texto === 'presente') {
              doc.setFillColor(25, 135, 84);
            } else {
              doc.setFillColor(220, 53, 69);
            }
          }
        }
      });
      const nombreArchivo = `Reporte_Asistencia_${subgrupoSeleccionado.replace(' ', '_')}.pdf`;
      doc.save(nombreArchivo);
    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
</main>
@endsection