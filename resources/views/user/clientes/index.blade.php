@extends('layouts.app_enterprise')

@section('title', 'Lista de Clientes')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header">
            <h2>Lista de Clientes</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('enterprise.clientes.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Cliente</a>

            <table id="clientes-table" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cédula Cliente</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->id_cliente }}</td>
                            <td>{{ $cliente->cedula_cliente }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellido }}</td>
                            <td>{{ $cliente->email }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->direccion }}</td>
                            <td>{{ $cliente->fecha_nacimiento }}</td>
                            <td>
                                <a href="{{ route('enterprise.clientes.show', $cliente->id_cliente) }}" class="btn btn-info">Ver</a>
                                <a href="{{ route('enterprise.clientes.edit', $cliente->id_cliente) }}" class="btn btn-primary">Editar</a>
                                <form action="{{ route('enterprise.clientes.destroy', $cliente->id_cliente) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
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
        // Inicializar el plugin DataTables en la tabla con el ID 'clientes-table'
        $(document).ready(function() {
            $('#clientes-table').DataTable();
        });
    </script>
@endpush
