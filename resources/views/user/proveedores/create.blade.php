@extends('layouts.app_enterprise')

@section('content')
    <div class="container py-3">
        <h1>Agregar Proveedor</h1>
        <form action="{{ route('enterprise.proveedores.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="identificador_ruc">Identificador RUC:</label>
                <input type="text" name="identificador_ruc" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre_empresa">Nombre de la Empresa:</label>
                <input type="text" name="nombre_empresa" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="ciudad_proveedor">Ciudad del Proveedor:</label>
                <input type="text" name="ciudad_proveedor" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
    </div>
@endsection
