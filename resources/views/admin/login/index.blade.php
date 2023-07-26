@extends('layouts.app')

@section('title', 'Login Administrador')

@section('content')

<style>
    .app-container-login-admin {
        min-height: 100vh;
        align-items: center;
        justify-content: center;
        display: flex;
    }
</style>
<div class="app-container-login-admin">
    <div class="login-box">
        <div class="login-logo">
            <!-- Agrega aquí la etiqueta img con la ruta de la imagen -->
            <a href="#"><img style="width: 250px;" src="{{ asset('img/logo.png') }}" alt="Logo"></a>
        </div>

        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Inicia sesión como administrador</p>

                @if($errors->any())
                <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                    {{ $error }}
                    @endforeach
                </div>
                @endif

                <form action="{{ route('admin.login') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="cedula" class="form-control" placeholder="Cédula" required>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection