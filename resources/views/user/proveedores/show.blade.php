@extends('layouts.app_enterprise')

@section('content')
    <div class="container py-3">
        <h1>Detalles del Proveedor</h1>
        <p><strong>Nombre:</strong> {{ $proveedor->nombre }}</p>
        <p><strong>Cédula/RUC:</strong> {{ $proveedor->cedula_ruc }}</p>
        <p><strong>Identificador RUC:</strong> {{ $proveedor->identificador_ruc }}</p>
        <p><strong>Nombre de la Empresa:</strong> {{ $proveedor->nombre_empresa }}</p>
        <p><strong>Teléfono:</strong> {{ $proveedor->telefono }}</p>
        <p><strong>Ciudad del Proveedor:</strong> {{ $proveedor->ciudad_proveedor }}</p>
        <a href="{{ route('enterprise.proveedores.index') }}" class="btn btn-primary">Volver</a>
    </div>
@endsection
