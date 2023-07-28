@extends('layouts.app_enterprise')

@section('title', 'Editar Categoría')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header">
            <h2>Editar Categoría</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('enterprise.categorias.update', $categoria->id_categoria) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nombre_categoria">Nombre de la Categoría:</label>
                    <input type="text" name="nombre_categoria" id="nombre_categoria" class="form-control" value="{{ $categoria->nombre_categoria }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('enterprise.categorias.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
