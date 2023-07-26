@extends('layouts.app_admin')

@section('title', 'Crear Nuevo Perfil de Usuario')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header">
            <h2>Crear Nuevo Perfil de Usuario</h2>
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
            <form action="{{ route('admin.usuarios.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="cedula_ruc" class="form-label">Cédula/RUC:</label>
                    <input type="text" name="cedula_ruc" id="cedula_ruc" class="form-control" required>
                    <button type="button" class="btn btn-primary mt-2" id="buttonsearchCedula" onclick="fetchCedulaInfo()">Consultar Cédula/RUC</button>
                </div>
                <div class="mb-3">
                    <label for="tipo_cliente" class="form-label">Tipo de Cliente:</label>
                    <input type="text" name="tipo_cliente" id="tipo_cliente" class="form-control" required readonly>
                </div>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" required readonly>
                </div>
                <div class="mb-3">
                    <label for="apellido" class="form-label">Apellido:</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" required readonly>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" name="telefono" id="telefono" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="estado" class="form-label">Estado:</label>
                    <select name="estado" id="estado" class="form-control" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Crear Perfil</button>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function capitalizeFirstLetter(str) {
        return str.toLowerCase().replace(/^\w|\s\w/g, c => c.toUpperCase());
    }

    function fetchCedulaInfo() {
        const cedula = document.getElementById('cedula_ruc').value;
        fetch('https://consultarucecuador.infotransitoec.com/api/api1.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    ni: cedula
                }),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.error)

                if (data.error === "No existe Ruc") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'La identificación ingresada es inválida!',
                    })
                    return;
                }

                document.getElementById('tipo_cliente').value = capitalizeFirstLetter(data.tipoContribuyente);
                document.getElementById('cedula_ruc').readOnly = true;
                document.getElementById('buttonsearchCedula').disabled = true;
                const nombresApellidos = data.razonSocial.split(" ");
                const numNombresApellidos = nombresApellidos.length;
                if (numNombresApellidos >= 4) {
                    document.getElementById('apellido').value = capitalizeFirstLetter(nombresApellidos.slice(0, numNombresApellidos - 2).join(" "));
                    document.getElementById('nombre').value = capitalizeFirstLetter(nombresApellidos.slice(numNombresApellidos - 2).join(" "));
                } else if (numNombresApellidos == 3) {
                    document.getElementById('apellido').value = capitalizeFirstLetter(nombresApellidos[0] + " " + nombresApellidos[1]);
                    document.getElementById('nombre').value = capitalizeFirstLetter(nombresApellidos[2]);
                } else if (numNombresApellidos == 2) {
                    document.getElementById('apellido').value = capitalizeFirstLetter(nombresApellidos[0]);
                    document.getElementById('nombre').value = capitalizeFirstLetter(nombresApellidos[1]);
                } else {
                    document.getElementById('apellido').value = "";
                    document.getElementById('nombre').value = "";
                }
                // Actualizar otros campos aquí si es necesario
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>
@endsection