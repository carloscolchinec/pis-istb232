@extends('layouts.app_enterprise')

@section('content')
    <div class="container py-3">
        <h1>Editar Ingreso de Productos</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('enterprise.ingreso-productos.update', $ingresoProducto->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="proveedor_id">Proveedor:</label>
                <select name="proveedor_id" id="proveedor_id" class="form-control" required>
                    <option value="">Seleccionar proveedor</option>
                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}" @if ($ingresoProducto->proveedor_id == $proveedor->id) selected @endif>{{ $proveedor->nombre_empresa }}</option>
                    @endforeach
                </select>
            </div>
            <div id="productos-container">
                @foreach ($ingresoProducto->detalles as $index => $detalle)
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre_producto_{{ $index }}">Nombre del Producto:</label>
                                <input type="text" name="nombre_producto[]" id="nombre_producto_{{ $index }}" class="form-control" value="{{ $detalle->nombre_producto }}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="precio_unitario_{{ $index }}">Precio Unitario:</label>
                                <input type="number" name="precio_unitario[]" id="precio_unitario_{{ $index }}" class="form-control" min="0" step="0.01" value="{{ $detalle->precio_unitario }}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="cantidad_{{ $index }}">Cantidad:</label>
                                <input type="number" name="cantidad[]" id="cantidad_{{ $index }}" class="form-control" min="1" value="{{ $detalle->cantidad }}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="fecha_ingreso_{{ $index }}">Fecha de Ingreso:</label>
                                <input type="date" name="fecha_ingreso[]" id="fecha_ingreso_{{ $index }}" class="form-control" value="{{ $detalle->fecha_ingreso }}" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            @if ($index === 0) {{-- Prevent removing the first product row --}}
                                <button type="button" class="btn btn-success btn-add-product" style="margin-top: 32px;">Agregar Producto</button>
                            @else
                                <button type="button" class="btn btn-danger btn-remove-product" style="margin-top: 32px;">Eliminar</button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let productIdCounter = {{ count($ingresoProducto->detalles) }};
            const productosContainer = document.getElementById('productos-container');
            const btnAddProduct = document.querySelector('.btn-add-product');

            function createProductRow() {
                const newRow = document.createElement('div');
                newRow.className = 'row';
                newRow.innerHTML = `
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nombre_producto_${productIdCounter}">Nombre del Producto:</label>
                            <input type="text" name="nombre_producto[]" id="nombre_producto_${productIdCounter}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="precio_unitario_${productIdCounter}">Precio Unitario:</label>
                            <input type="number" name="precio_unitario[]" id="precio_unitario_${productIdCounter}" class="form-control" min="0" step="0.01" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="cantidad_${productIdCounter}">Cantidad:</label>
                            <input type="number" name="cantidad[]" id="cantidad_${productIdCounter}" class="form-control" min="1" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="fecha_ingreso_${productIdCounter}">Fecha de Ingreso:</label>
                            <input type="date" name="fecha_ingreso[]" id="fecha_ingreso_${productIdCounter}" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-remove-product" style="margin-top: 32px;">Eliminar</button>
                    </div>
                `;

                return newRow;
            }

            function addProductRow() {
                const newProductRow = createProductRow();
                productosContainer.appendChild(newProductRow);
                productIdCounter++;
            }

            btnAddProduct.addEventListener('click', function() {
                addProductRow();
            });

            productosContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('btn-remove-product')) {
                    const productRow = event.target.closest('.row');
                    productosContainer.removeChild(productRow);
                }
            });
        });
    </script>
@endsection
