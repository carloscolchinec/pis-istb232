@extends('layouts.app_admin')

@section('title', 'Detalles del Perfil de Usuario')

@section('content')
    <div class="container-fluid py-3">
    <div class="card">
        <div class="card-header">
            <h2>Detalles del Perfil de Usuario</h2>
        </div>
        <div class="card-body">
        <p><strong>ID:</strong> {{ $perfil->id_cliente }}</p>
            <p><strong>Cédula/RUC:</strong> {{ $perfil->cedula_ruc }}</p>
            <p><strong>Tipo de Cliente:</strong> {{ $perfil->tipo_cliente }}</p>
            <p><strong>Nombre:</strong> {{ $perfil->nombre }}</p>
            <p><strong>Apellido:</strong> {{ $perfil->apellido }}</p>
            <p><strong>Email:</strong> {{ $perfil->email }}</p>
            <p><strong>Teléfono:</strong> {{ $perfil->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $perfil->direccion }}</p>
            <p><strong>Fecha de Nacimiento:</strong> {{ $perfil->fecha_nacimiento }}</p>
            <p><strong>Estado:</strong> {{ $perfil->estado ? 'Activo' : 'Inactivo' }}</p>
            <!-- Agrega más campos aquí si es necesario -->
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
    </div>
@endsection
