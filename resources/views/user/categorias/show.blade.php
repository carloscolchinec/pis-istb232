@extends('layouts.app_enterprise')

@section('title', 'Detalles de la Categoría')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header">
            <h2>Detalles de la Categoría</h2>
        </div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $categoria->id_categoria }}</p>
            <p><strong>Nombre:</strong> {{ $categoria->nombre_categoria }}</p>

            <a href="{{ route('enterprise.categorias.index') }}" class="btn btn-primary">Volver</a>
        </div>
    </div>
</div>
@endsection
