@extends('layouts.app_enterprise')

@section('title', 'Lista de Categorías')

@section('content')
    <div class="container-fluid py-3">
        <h2>Lista de Categorías</h2>
        <div class="card">
            <div class="card-body">
                <a href="{{ route('enterprise.categorias.create') }}" class="btn btn-primary mb-3">Crear Nueva Categoría</a>

                <table id="categorias-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Categoría</th>
                            <th>Cantidad de Productos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categorias as $categoria)
                            <tr>
                                <td>{{ $categoria->id_categoria }}</td>
                                <td>{{ $categoria->nombre_categoria }}</td>
                                <td>{{ $cantidadProductosPorCategoria[$categoria->id_categoria] }}</td>
                                <td>
                                    <a href="{{ route('enterprise.categorias.show', $categoria->id_categoria) }}" class="btn btn-info">Ver</a>
                                    <a href="{{ route('enterprise.categorias.edit', $categoria->id_categoria) }}" class="btn btn-primary">Editar</a>
                                    <form action="{{ route('enterprise.categorias.destroy', $categoria->id_categoria) }}" method="POST">
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
        // Inicializar el plugin DataTables en la tabla con el ID 'categorias-table'
        $(document).ready(function() {
            $('#categorias-table').DataTable();
        });
    </script>
@endpush
