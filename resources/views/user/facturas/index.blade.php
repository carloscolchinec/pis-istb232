<!-- resources/views/user/facturas/index.blade.php -->

@extends('layouts.app_enterprise')

@section('title', 'Lista de Facturas')

@section('content')
    <div class="container-fluid py-3">
        <h2>Lista de Facturas</h2>
        <a href="{{ route('enterprise.facturas.create') }}" class="btn btn-primary mb-3">Crear Nueva Factura</a>

        <table id="facturas-table" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cédula/RUC Cliente</th>
                    <th>Total Factura</th>
                    <th>Fecha Factura</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($facturas as $factura)
                    <tr>
                        <td>{{ $factura->id_factura }}</td>
                        <td>{{ $factura->cedula_cliente }}</td>
                        <td>{{ $factura->total_factura }}</td>
                        <td>{{ $factura->fecha_factura }}</td>
                        <td>
                            <a href="{{ route('enterprise.facturas.show', $factura->id_factura) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                            <form action="{{ route('enterprise.facturas.destroy', $factura->id_factura) }}" method="POST" style="display: inline-block;">
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
        // Inicializar el plugin DataTables en la tabla con el ID 'facturas-table'
        $(document).ready(function() {
            $('#facturas-table').DataTable();
        });
    </script>
@endpush
