@extends('colaborador.pagos.partials.layout')

@section('contenido')
<div class="container mt-4">
    <h3 class="mb-4">Registrar Pago</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @include('colaborador.pagos.partials.formulario', ['modo' => 'crear'])
</div>
@endsection
