@extends('layouts.app_enterprise')

@section('content')
    <div class="container">
        <h1>Editar Proveedor</h1>
        <form action="{{ route('enterprise.proveedores.update', $proveedor->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" value="{{ $proveedor->nombre }}" required>
            </div>
  
            <div class="form-group">
                <label for="identificador_ruc">Identificador RUC:</label>
                <input type="text" name="identificador_ruc" class="form-control" value="{{ $proveedor->identificador_ruc }}" required>
            </div>
            <div class="form-group">
                <label for="nombre_empresa">Nombre de la Empresa:</label>
                <input type="text" name="nombre_empresa" class="form-control" value="{{ $proveedor->nombre_empresa }}" required>
            </div>
            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" class="form-control" value="{{ $proveedor->telefono }}" required>
            </div>
            <div class="form-group">
                <label for="ciudad_proveedor">Ciudad del Proveedor:</label>
                <input type="text" name="ciudad_proveedor" class="form-control" value="{{ $proveedor->ciudad_proveedor }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>
@endsection
