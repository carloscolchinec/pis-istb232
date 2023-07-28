@extends('layouts.app_enterprise')

@section('title', 'Editar Producto')

@section('content')
    <div class="container-fluid py-3">
        <h2>Editar Producto</h2>
        <form action="{{ route('enterprise.productos.update', $producto->id_producto) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="codigo_producto">Código:</label>
                <input type="text" name="codigo_producto" id="codigo_producto" class="form-control" value="{{ $producto->codigo_producto }}" required>
            </div>
            <div class="form-group">
                <label for="nombre_producto">Nombre:</label>
                <input type="text" name="nombre_producto" id="nombre_producto" class="form-control" value="{{ $producto->nombre_producto }}" required>
            </div>
            <div class="form-group">
                <label for="descripcion_producto">Descripción:</label>
                <textarea name="descripcion_producto" id="descripcion_producto" class="form-control" rows="4" required>{{ $producto->descripcion_producto }}</textarea>
            </div>
            <div class="form-group">
                <label for="precio_unitario">Precio Unitario del Producto:</label>
                <input type="text" name="precio_unitario" class="form-control" value="{{ $producto->precio_unitario }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_de_caducidad">Fecha de Caducidad:</label>
                <input type="date" name="fecha_de_caducidad" id="fecha_de_caducidad" class="form-control" value="{{ $producto->fecha_de_caducidad }}" required>
            </div>
            <div class="form-group">
                <label for="stock_producto">Stock:</label>
                <input type="number" name="stock_producto" id="stock_producto" class="form-control" value="{{ $producto->stock_producto }}" required>
            </div>
            <div class="form-group">
                <label for="categoria_id">Categoría:</label>
                <select name="categoria_id" id="categoria_id" class="form-control" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}" @if($categoria->id_categoria === $producto->categoria_id) selected @endif>{{ $categoria->nombre_categoria }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Producto</button>
        </form>
    </div>
@endsection
