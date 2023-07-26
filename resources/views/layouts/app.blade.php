<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Sistema de Gestión y Control de Inventarios')</title>
    <!-- Agrega los estilos CSS de AdminLTE -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Agrega tus propios estilos CSS personalizados si es necesario -->
    @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
    



    @yield('content')
    </div>

    <!-- Agrega los scripts JS de AdminLTE -->
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- Agrega tus propios scripts JS personalizados si es necesario -->
    @stack('scripts')
</body>
</html>