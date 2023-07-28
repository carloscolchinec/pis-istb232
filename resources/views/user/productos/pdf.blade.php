@extends('layouts.pdf')

@section('content')
    <h2>Lista de Productos</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Fecha de Caducidad</th>
                <th>Stock</th>
                <th>Categoría</th>
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
                    <td>{{ $producto->categoria->nombre_categoria }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
