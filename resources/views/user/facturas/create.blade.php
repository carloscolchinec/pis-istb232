@extends('layouts.app_enterprise')

@section('title', 'Crear Factura')

@section('content')
<div class="container-fluid py-3">
    <h2>Crear Factura</h2>
    <form action="{{ route('enterprise.facturas.store') }}" method="POST" id="factura-form">
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
                    <th>Total Individual</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="detalles-table">
                <tr>
                    <td>
                        <select name="nombre_producto[]" class="form-control producto-select" required>
                            <option value="">Seleccionar Producto</option>
                            @foreach ($productos as $producto)
                            <option value="{{ $producto->nombre_producto }}" data-precio="{{ $producto->precio_unitario }}" data-stock="{{ $producto->stock }}">{{ $producto->nombre_producto }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td><input type="text" name="precio_producto[]" class="form-control precio-input" required readonly></td>
                    <td><input type="text" name="stock_producto[]" class="form-control stock-input" required></td>
                    <td><input type="text" name="total_individual[]" class="form-control total-individual" readonly></td>
                    <td><button type="button" class="btn btn-danger btn-sm delete-product">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
        <!-- Add more rows for additional products -->
        <button type="button" class="btn btn-primary mt-3" id="add-product">Agregar Producto</button>
        <button type="submit" class="btn btn-success mt-3">Crear Factura</button>
    </form>
</div>
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

        // Función para calcular el total individual de un producto y actualizar el campo correspondiente
        function calcularTotalIndividual(precio, stock) {
            return (parseFloat(precio) * parseInt(stock)).toFixed(2);
        }

        // Función para calcular el total de la factura y actualizar el campo correspondiente
        function calcularTotalFactura() {
            let totalFactura = 0;
            const filas = document.querySelectorAll("#detalles-table tr");
            filas.forEach(function(fila) {
                const precioInput = fila.querySelector(".precio-input");
                const stockInput = fila.querySelector(".stock-input");
                const totalIndividualInput = fila.querySelector(".total-individual");

                const precio = parseFloat(precioInput.value) || 0;
                const stock = parseInt(stockInput.value) || 0;

                totalIndividualInput.value = calcularTotalIndividual(precio, stock);

                totalFactura += parseFloat(totalIndividualInput.value);
            });

            const iva = parseFloat(document.getElementById("iva").value);
            totalFactura = totalFactura + totalFactura * iva;
            document.getElementById("total_factura").value = totalFactura.toFixed(2);
        }


        // Evento para calcular el total al cargar la página
        calcularTotalFactura();

        // Evento al cambiar la selección de un producto para obtener su precio y actualizar el campo correspondiente
        const productosSelects = document.querySelectorAll(".producto-select");
        productosSelects.forEach(function(select) {
            select.addEventListener("change", function() {
                const precioProducto = obtenerPrecioProducto(this);
                this.closest("tr").querySelector(".precio-input").value = precioProducto.toFixed(2);
                const stockDisponible = obtenerStockDisponible(this);
                this.closest("tr").querySelector(".stock-input").max = stockDisponible;
                this.closest("tr").querySelector(".stock-input").value = Math.min(stockDisponible, 1);
                calcularTotalFactura();
            });
        });

        // Evento para cambiar el % del IVA
        document.getElementById("iva").addEventListener("change", function() {
            calcularTotalFactura();
        });

        // Evento para agregar una nueva fila de producto
        document.getElementById("add-product").addEventListener("click", function() {
            const detallesTable = document.getElementById("detalles-table");
            const newRow = detallesTable.insertRow();
            newRow.innerHTML = `
                <td>
                    <select name="nombre_producto[]" class="form-control producto-select" required>
                        <option value="">Seleccionar Producto</option>
                        @foreach ($productos as $producto)
                        <option value="{{ $producto->nombre_producto }}" data-precio="{{ $producto->precio_unitario }}" data-stock="{{ $producto->stock }}">{{ $producto->nombre_producto }}</option>
                        @endforeach
                    </select>
                </td>
                <td><input type="text" name="precio_producto[]" class="form-control precio-input" required readonly></td>
                <td><input type="text" name="stock_producto[]" class="form-control stock-input" required></td>
                <td><input type="text" name="total_individual[]" class="form-control total-individual" readonly></td>
                <td><button type="button" class="btn btn-danger btn-sm delete-product">Eliminar</button></td>
            `;

            // Evento para calcular el total al cambiar la selección de un producto en la nueva fila
            const selectProducto = newRow.querySelector(".producto-select");
            const precioInput = newRow.querySelector(".precio-input");
            const stockInput = newRow.querySelector(".stock-input");
            const totalIndividualInput = newRow.querySelector(".total-individual");

            selectProducto.addEventListener("change", function() {
                const precioProducto = obtenerPrecioProducto(this);
                precioInput.value = precioProducto.toFixed(2);
                const stockDisponible = obtenerStockDisponible(this);
                stockInput.max = stockDisponible;
                stockInput.value = Math.min(stockDisponible, 1);
                totalIndividualInput.value = calcularTotalIndividual(precioProducto, stockInput.value);
                calcularTotalFactura();
            });

            stockInput.addEventListener("input", function() {
                totalIndividualInput.value = calcularTotalIndividual(precioInput.value, this.value);
                calcularTotalFactura();
            });

            calcularTotalFactura();
        });

        // Evento para eliminar una fila de producto
        document.addEventListener("click", function(e) {
            if (e.target.classList.contains("delete-product")) {
                const row = e.target.closest("tr");
                row.parentNode.removeChild(row);
                calcularTotalFactura();
            }
        });
    });
</script>
@endsection
