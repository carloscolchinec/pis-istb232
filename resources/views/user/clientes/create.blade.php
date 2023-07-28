@extends('layouts.app_enterprise')

@section('title', 'Agregar Nuevo Cliente')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header">
            <h2>Agregar Nuevo Cliente</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('enterprise.clientes.store') }}" method="POST">
                @csrf
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <div class="form-group">
                    <label for="cedula_cliente">Cédula Cliente:</label>
                    <input type="text" name="cedula_cliente" id="cedula_cliente" class="form-control" value="{{ old('cedula_cliente') }}" required>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" required>
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" value="{{ old('apellido') }}" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}" required>
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" value="{{ old('direccion') }}" required>
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ old('fecha_nacimiento') }}" required>
                </div>
                <!-- Agrega más campos aquí si es necesario -->

                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('enterprise.clientes.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection