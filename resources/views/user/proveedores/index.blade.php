@extends('layouts.app_enterprise')

@section('content')
    <div class="container py-3">
        <h1>Lista de Proveedores</h1>
        <a href="{{ route('enterprise.proveedores.create') }}" class="btn btn-primary">Agregar Proveedor</a>
        <table class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Identificador RUC</th>
                    <th>Nombre Empresa</th>
                    <th>Teléfono</th>
                    <th>Ciudad Proveedor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                    <tr>
                        <td>{{ $proveedor->id }}</td>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->identificador_ruc }}</td>
                        <td>{{ $proveedor->nombre_empresa }}</td>
                        <td>{{ $proveedor->telefono }}</td>
                        <td>{{ $proveedor->ciudad_proveedor }}</td>
                        <td>
                            <a href="{{ route('enterprise.proveedores.show', $proveedor->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('enterprise.proveedores.edit', $proveedor->id) }}" class="btn btn-primary btn-sm">Editar</a>
                            <form action="{{ route('enterprise.proveedores.destroy', $proveedor->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
