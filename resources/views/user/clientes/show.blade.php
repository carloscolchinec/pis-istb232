@extends('layouts.app_enterprise')

@section('title', 'Detalles del Cliente')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header">
            <h2>Detalles del Cliente</h2>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $cliente->id_cliente }}</p>
            <p><strong>Cédula Cliente:</strong> {{ $cliente->cedula_cliente }}</p>
            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $cliente->apellido }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $cliente->fecha_nacimiento }}</p>
            <!-- Agrega más campos aquí si es necesario -->
            <a href="{{ route('enterprise.clientes.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
@endsection
