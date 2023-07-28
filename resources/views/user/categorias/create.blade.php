@extends('layouts.app_enterprise')

@section('title', 'Crear Nueva Categoría')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header">
            <h2>Crear Nueva Categoría</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('enterprise.categorias.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="nombre_categoria">Nombre de la Categoría:</label>
                    <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-primary">Crear</button>
                <a href="{{ route('enterprise.categorias.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
