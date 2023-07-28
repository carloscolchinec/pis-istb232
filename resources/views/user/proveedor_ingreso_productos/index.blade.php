@extends('layouts.app_enterprise')

@section('content')
    <div class="container py-3">
        <h1>Ingresos de Productos</h1>
        <a href="{{ route('enterprise.ingreso-productos.create') }}" class="btn btn-success">Agregar Ingreso de Productos</a>
        <hr>
        @if (count($ingresosProductos) > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Proveedor</th>
                        <th>Nombre del Producto</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Fecha de Ingreso</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ingresosProductos as $ingresoProducto)
                        <tr>
                            <td>{{ $ingresoProducto->id }}</td>
                            <td>{{ $ingresoProducto->proveedor->nombre_empresa }}</td>
                            <td>{{ $ingresoProducto->nombre_producto }}</td>
                            <td>{{ $ingresoProducto->precio_unitario }}</td>
                            <td>{{ $ingresoProducto->cantidad }}</td>
                            <td>{{ $ingresoProducto->fecha_ingreso }}</td>
                            <td>
                                <a href="{{ route('enterprise.ingreso-productos.show', $ingresoProducto->id) }}"
                                    class="btn btn-info btn-sm">Ver</a>

                                <form action="{{ route('enterprise.ingreso-productos.destroy', $ingresoProducto->id) }}"
                                    method="POST" style="display: inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar este ingreso de productos?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $ingresosProductos->links() }}
        @else
            <p>No se encontraron ingresos de productos.</p>
        @endif
    </div>
@endsection
