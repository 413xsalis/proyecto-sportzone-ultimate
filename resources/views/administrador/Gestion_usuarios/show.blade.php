@extends('layouts.app1')

@section('title', 'Detalle de Producto')

@section('content')
<div class="container mt-3">
    <h2>Detalle del Producto</h2>
    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->description }}</p>
            <p class="card-text"><strong>Precio:</strong> ${{ number_format($product->price, 2) }}</p>
            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Editar</a>
            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Volver</a>
        </div>
    </div>
</div>
@endsection