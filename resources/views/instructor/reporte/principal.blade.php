@extends('instructor.reporte.layout')

@section('nav-message')
Bienvenido - Panel de control de instructores
@endsection


@section('content')

<main class="app-content">
  <div class="container mt-5">
    <h4 class="mb-4 text-center fw-bold text-primary">Reporte de Asistencias</h4>

    {{-- Formulario de filtrado --}}
    <form method="GET" action="{{ route('inst.reporte.asistencias') }}" class="row g-3 mb-4">
      <div class="col-md-4">
        <label for="grupo_id" class="form-label">Filtrar por Grupo</label>
        <select name="grupo_id" id="grupo_id" class="form-select" required>
          <option value="">Seleccione...</option>
          @foreach($grupos as $grupo)
          <option value="{{ $grupo->id }}" {{ request('grupo_id') == $grupo->id ? 'selected' : '' }}>
            {{ $grupo->nombre }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4">
        <label for="subgrupo_id" class="form-label">Filtrar por Subgrupo</label>
        <select name="subgrupo_id" id="subgrupo_id" class="form-select" required>
          <option value="">Seleccione...</option>
          @if(request('grupo_id'))
          @foreach(\App\Models\Subgrupo::where('grupo_id', request('grupo_id'))->get() as $sub)
          <option value="{{ $sub->id }}" {{ request('subgrupo_id') == $sub->id ? 'selected' : '' }}>
            {{ $sub->nombre }}
          </option>
          @endforeach
          @endif
        </select>
      </div>
      <div class="col-md-4">
        <label for="fecha" class="form-label">Filtrar por Fecha</label>
        <input type="date" name="fecha" id="fecha" class="form-control" value="{{ request('fecha') }}" required>
      </div>
      <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-info w-100">Filtrar</button>
      </div>
    </form>

    {{-- Incluye la vista de la tabla de asistencias --}}
    @include('instructor.reporte.asistencias')
  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const grupoSelect = document.getElementById('grupo_id');
      const subgrupoSelect = document.getElementById('subgrupo_id');
      const subgruposUrl = "{{ route('inst.get.subgrupos', ['grupoId' => 'REPLACE']) }}";

      grupoSelect.addEventListener('change', function() {
        const grupoId = this.value;
        if (grupoId) {
          const url = subgruposUrl.replace('REPLACE', grupoId);
          // Realiza la llamada AJAX
          fetch(url)
            .then(response => response.json())
            .then(data => {
              subgrupoSelect.innerHTML = '<option value="">Seleccione...</option>';
              data.forEach(subgrupo => {
                const option = document.createElement('option');
                option.value = subgrupo.id;
                option.textContent = subgrupo.nombre;
                subgrupoSelect.appendChild(option);
              });
            })
            .catch(error => console.error('Error:', error));
        } else {
          subgrupoSelect.innerHTML = '<option value="">Seleccione...</option>';
        }
      });

      if (grupoSelect.value) {
        grupoSelect.dispatchEvent(new Event('change'));
      }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="app.js"></script>
</main>
@endsection