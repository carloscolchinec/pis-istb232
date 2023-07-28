@extends('layouts.app_enterprise')

@section('title', 'Lista de Productos')

@section('content')
<div class="container-fluid py-3">
    <h2>Lista de Productos</h2>
    <a href="{{ route('enterprise.productos.create') }}" class="btn btn-primary mb-3">Crear Nuevo Producto</a>

    <table id="productos-table" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de Caducidad</th>
                <th>Stock</th>
                <th>Precio Unitario</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->id_producto }}</td>
                <td>{{ $producto->codigo_producto }}</td>
                <td>{{ $producto->nombre_producto }}</td>
                <td>{{ $producto->descripcion_producto }}</td>
                <td>{{ $producto->fecha_de_caducidad }}</td>
                <td>{{ $producto->stock_producto }}</td>
                <td>{{ $producto->precio_unitario }}</td>
                <td>{{ $producto->categoria->nombre_categoria }}</td>
                <td>
                    <a href="{{ route('enterprise.productos.show', $producto->id_producto) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('enterprise.productos.edit', $producto->id_producto) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('enterprise.productos.destroy', $producto->id_producto) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('styles')
<!-- Agrega el CSS de DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endpush

@push('scripts')
<!-- Agrega el JS de jQuery y DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

<script>
    // Inicializar el plugin DataTables en la tabla con el ID 'productos-table'

    $(document).ready(function() {
        $('#productos-table').DataTable();
    });
</script>
@endpush