@extends('layouts.app_admin')

@section('title', 'Lista de Perfiles de Usuario')

@section('content')

<style>
    /* Estilo para la celda que contiene los botones */
    .button-cell {
        display: flex;
        gap: 5px; /* Ajusta el espacio entre los botones */
    }
</style>
   <div class="container-fluid py-3">
   <div class="card">
        <div class="card-header">
            <h2>Lista de Perfiles de Usuario</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <a href="{{ route('admin.usuarios.create') }}" class="btn btn-primary mb-3">Crear Nuevo Perfil de Usuario</a>

            <table id="usuarios-table" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Cédula/RUC</th>
            <th>Tipo de Cliente</th>
            <th>Nombre</th>
            <th>Apellido</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($perfiles as $perfil)
            <tr>
                <td>{{ $perfil->id_cliente }}</td>
                <td>{{ $perfil->cedula_ruc }}</td>
                <td>{{ $perfil->tipo_cliente }}</td>
                <td>{{ $perfil->nombre }}</td>
                <td>{{ $perfil->apellido }}</td>
                <td>
                    @if ($perfil->estado)
                        <span class="badge bg-success">Activo</span>
                    @else
                        <span class="badge bg-danger">Inactivo</span>
                    @endif
                </td>
                <td class="button-cell"> <!-- Agrega la clase "button-cell" a esta celda -->
                    <a href="{{ route('admin.usuarios.show', $perfil->id_cliente) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                    <a href="{{ route('admin.usuarios.edit', $perfil->id_cliente) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('admin.usuarios.destroy', $perfil->id_cliente) }}" method="POST">
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
        // Inicializar el plugin DataTables en la tabla con el ID 'usuarios-table'
        $(document).ready(function() {
            $('#usuarios-table').DataTable();
        });
    </script>
@endpush
