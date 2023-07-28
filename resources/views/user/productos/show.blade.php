@extends('layouts.app_enterprise')

@section('title', 'Detalles del Producto')

@section('content')
    <div class="container-fluid py-3">
        <h2>Detalles del Producto</h2>
        <p><strong>ID:</strong> {{ $producto->id_producto }}</p>
        <p><strong>Código:</strong> {{ $producto->codigo_producto }}</p>
        <p><strong>Nombre:</strong> {{ $producto->nombre_producto }}</p>
        <p><strong>Descripción:</strong> {{ $producto->descripcion_producto }}</p>
        <p><strong>Fecha de Caducidad:</strong> {{ $producto->fecha_de_caducidad }}</p>
        <p><strong>Stock:</strong> {{ $producto->stock_producto }}</p>
        <p><strong>Categoría:</strong> {{ $producto->categoria->nombre_categoria }}</p>
        <!-- Agrega más campos aquí si es necesario -->
        <a href="{{ route('enterprise.productos.index') }}" class="btn btn-primary">Volver</a>
    </div>
@endsection
