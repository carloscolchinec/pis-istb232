@extends('layouts.app_enterprise')

@section('title', 'Crear Factura')

@section('content')
<div class="container-fluid py-3">
    <h2>Crear Factura</h2>
    <form action="{{ route('enterprise.facturas.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="cedula_cliente">Cédula o RUC del Cliente:</label>
            <select name="cedula_cliente" class="form-control" required>
                <option value="">Seleccionar Cliente</option>
                @foreach ($clientes as $cliente)
                <option value="{{ $cliente->cedula_cliente }}">{{ $cliente->cedula_cliente . ' (' . $cliente->nombre . ' ' . $cliente->apellido .  ')'}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_factura">Fecha de la Factura:</label>
            <input type="date" name="fecha_factura" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="total_factura">Total de la Factura:</label>
            <input type="number" name="total_factura" id="total_factura" class="form-control" required readonly>
        </div>
        <div class="form-group">
            <label for="iva">IVA:</label>
            <select name="iva" id="iva" class="form-control" required>
                <option value="0.12" selected>12%</option>
                <option value="0.14">14%</option>
            </select>
        </div>
        <h3>Detalles de la Factura:</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre del Producto</th>
                    <th>Precio del Producto</th>
                    <th>Stock del Producto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="detalles-table">
                <tr>
                    <td>
                        <select name="nombre_producto[]" class="form-control" required>
                            <option value="">Seleccionar Producto</option>
                            @foreach ($productos as $producto)
                            <option value="{{ $producto->nombre_producto }}" data-precio="{{ $producto->precio_unitario }}">{{ $producto->nombre_producto }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="number" name="precio_producto[]" class="form-control" required readonly></td>
                    <td><input type="number" name="stock_producto[]" class="form-control" required></td>
                    <td><button type="button" class="btn btn-danger btn-sm delete-product">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
        <!-- Add more rows for additional products -->
        <button type="button" class="btn btn-primary mt-3" id="add-product">Agregar Producto</button>
        <button type="submit" class="btn btn-success mt-3">Crear Factura</button>
    </form>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Función para obtener el precio de un producto seleccionado
        function obtenerPrecioProducto(selector) {
            return parseFloat(selector.options[selector.selectedIndex].getAttribute("data-precio")) || 0;
        }

        // Función para obtener el stock disponible de un producto seleccionado
        function obtenerStockDisponible(selector) {
            return parseInt(selector.options[selector.selectedIndex].getAttribute("data-stock")) || 0;
        }

        // Función para calcular el total de la factura y actualizar el campo correspondiente
        function calcularTotal() {
            let total = 0;
            const productos = document.querySelectorAll("input[name='precio_producto[]']");
            productos.forEach(function(producto) {
                console.log(productos)
                const precio = parseFloat(producto.value) || 0;
                const stockDisponible = obtenerStockDisponible(producto.closest("tr").querySelector("select[name='nombre_producto[]']"));
                const stockSolicitado = parseInt(producto.closest("tr").querySelector("input[name='stock_producto[]']").value) || 0;
                const stockUsado = Math.min(stockDisponible, stockSolicitado);
                total += precio * stockUsado;

            });
            
            const iva = parseFloat(document.getElementById("iva").value);
            total = total + total * iva;
            console.log(total)
            document.getElementById("total_factura").value = total.toFixed(2);
        }

        // Evento al cambiar la selección de un producto para obtener su precio y actualizar el campo correspondiente
        const productosSelects = document.querySelectorAll("select[name='nombre_producto[]']");
        productosSelects.forEach(function(select) {
            select.addEventListener("change", function() {
                const precioProducto = obtenerPrecioProducto(this);
                this.closest("tr").querySelector("input[name='precio_producto[]']").value = precioProducto.toFixed(2);
                const stockDisponible = obtenerStockDisponible(this);
                this.closest("tr").querySelector("input[name='stock_producto[]']").max = stockDisponible;
                this.closest("tr").querySelector("input[name='stock_producto[]']").value = Math.min(stockDisponible, 1);
                calcularTotal();
            });
        });

        // Evento para cambiar el % del IVA
        document.getElementById("iva").addEventListener("change", function() {
            calcularTotal();
        });

        // Evento para agregar una nueva fila de producto
        document.getElementById("add-product").addEventListener("click", function() {
            const detallesTable = document.getElementById("detalles-table");
            const newRow = detallesTable.insertRow();
            newRow.innerHTML = `
                <td>
                    <select name="nombre_producto[]" class="form-control" required>
                        <option value="">Seleccionar Producto</option>
                        @foreach ($productos as $producto)
                        <option value="{{ $producto->nombre_producto }}" data-precio="{{ $producto->precio_unitario }}" data-stock="{{ $producto->stock }}">{{ $producto->nombre_producto }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="number" name="precio_producto[]" class="form-control" required readonly></td>
                <td><input type="number" name="stock_producto[]" class="form-control" required></td>
                <td><button type="button" class="btn btn-danger btn-sm delete-product">Eliminar</button></td>
            `;

            // Actualizar el precio y stock del nuevo producto seleccionado
            const index = detallesTable.rows.length - 1;
            const selectProducto = detallesTable.rows[index].querySelector("select[name='nombre_producto[]']");
            const precioProducto = obtenerPrecioProducto(selectProducto);
            detallesTable.rows[index].querySelector("input[name='precio_producto[]']").value = precioProducto.toFixed(2);
            selectProducto.addEventListener("change", function() {
                const precioProducto = obtenerPrecioProducto(this);
                this.closest("tr").querySelector("input[name='precio_producto[]']").value = precioProducto.toFixed(2);
                const stockDisponible = obtenerStockDisponible(this);
                this.closest("tr").querySelector("input[name='stock_producto[]']").max = stockDisponible;
                this.closest("tr").querySelector("input[name='stock_producto[]']").value = Math.min(stockDisponible, 1);
                calcularTotal();
            });

            calcularTotal();
        });

        // Evento para eliminar una fila de producto
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("delete-product")) {
                const row = e.target.closest("tr");
                row.parentNode.removeChild(row);
                calcularTotal();
            }
        });

        // Calcular el total inicial cuando se carga la página
        calcularTotal();
    });
</script>



@endsection


