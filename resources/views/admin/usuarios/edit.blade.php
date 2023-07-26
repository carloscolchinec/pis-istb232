@extends('layouts.app_admin')

@section('title', 'Editar Perfil de Usuario')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header">
            <h2>Editar Perfil de Usuario</h2>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card-body">
            <form action="{{ route('admin.usuarios.update', $perfil->id_cliente) }}" method="POST">
                @csrf
                @method('PUT')


                <div class="form-group">
                    <label for="cedula_ruc">Cédula/RUC:</label>
                    <input type="text" name="cedula_ruc" id="cedula_ruc" class="form-control" value="{{ $perfil->cedula_ruc }}" readonly>
                </div>
                <div class="form-group">
                    <label for="tipo_cliente">Tipo de Cliente:</label>
                    <input type="text" name="tipo_cliente" id="tipo_cliente" class="form-control" value="{{ $perfil->tipo_cliente }}" readonly>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="{{ $perfil->nombre }}">
                </div>
                <div class="form-group">
                    <label for="apellido">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" value="{{ $perfil->apellido }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ $perfil->email }}">
                </div>
                <div class="form-group">
                    <label for="password">Contraseña:</label>
                    <input type="text" name="password" id="password" class="form-control" value="{{$perfil->password}}">
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" value="{{ $perfil->telefono }}">
                </div>
                <div class="form-group">
                    <label for="direccion">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" value="{{ $perfil->direccion }}">
                </div>
                <div class="form-group">
                    <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" value="{{ $perfil->fecha_nacimiento }}">
                </div>
                <div class="form-group">
                    <label for="estado">Estado:</label>
                    <select name="estado" id="estado" class="form-control">
                        <option value="1" {{ $perfil->estado ? 'selected' : '' }}>Activo</option>
                        <option value="0" {{ !$perfil->estado ? 'selected' : '' }}>Inactivo</option>
                    </select>
                </div>
                <!-- Agrega más campos aquí si es necesario -->
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection