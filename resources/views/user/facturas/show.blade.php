@extends('layouts.app_enterprise')

@section('title', 'Detalles de Factura')

@section('content')
<div class="container-fluid py-3">
    <h2>Detalles de Factura</h2>
    <div class="row mt-4">
        <div class="col-md-6">
            <p><strong>Número de Factura:</strong> {{ $factura->id_factura }}</p>
            <p><strong>Cédula/RUC del Cliente:</strong> {{ $factura->cedula_cliente }}</p>
            <p><strong>Fecha de la Factura:</strong> {{ $factura->fecha_factura }}</p>
            <p><strong>Total de la Factura:</strong> {{ $factura->total_factura }}</p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <h4>Detalles de los Productos</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del Producto</th>
                        <th>Precio del Producto</th>
                        <th>Stock del Producto</th>
                        <th>Total Individual</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detallesFactura as $detalle)
                    <tr>
                        <td>{{ $detalle->nombre_producto }}</td>
                        <td>{{ $detalle->precio_producto }}</td>
                        <td>{{ $detalle->stock_producto }}</td>
                        <td>{{ $detalle->precio_producto * $detalle->stock_producto }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <a href="{{ route('enterprise.facturas.index') }}" class="btn btn-primary">Volver a la Lista de Facturas</a>
            <button id="btn-generar-pdf" class="btn btn-primary">Generar PDF</button>
        </div>
    </div>
</div>

<!-- Incluye pdfmake en tu proyecto -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js" integrity="sha512-a9NgEEK7tsCvABL7KqtUTQjl69z7091EVPpw5KxPlZ93T141ffe1woLtbXTX+r2/8TtTvRX/v4zTL2UlMUPgwg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js" integrity="sha512-pAoMgvsSBQTe8P3og+SAnjILwnti03Kz92V3Mxm0WOtHuA482QeldNM5wEdnKwjOnQ/X11IM6Dn3nbmvOz365g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // Función para generar el PDF al hacer clic en el botón
    pdfMake.fonts = {
        Roboto: {
            normal: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/fonts/Roboto/Roboto-Regular.ttf',
            bold: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/fonts/Roboto/Roboto-Medium.ttf',
            italics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/fonts/Roboto/Roboto-Italic.ttf',
            bolditalics: 'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.2/fonts/Roboto/Roboto-MediumItalic.ttf'
        }
    };

    // Función para generar el PDF al hacer clic en el botón
    document.getElementById('btn-generar-pdf').addEventListener('click', function () {
    // Definir la configuración del documento PDF
    var docDefinition = {
        content: [
            {
                text: 'Detalles de Factura',
                style: 'header',
                alignment: 'center',
                margin: [0, 20],
            },
            {
                text: 'Número de Factura: ' + escapeSpecialCharacters('{{ htmlspecialchars_decode($factura->id_factura) }}'),
                margin: [0, 5],
            },
            {
                text: 'Cédula/RUC del Cliente: ' + escapeSpecialCharacters('{{ htmlspecialchars_decode($factura->cedula_cliente) }}'),
                margin: [0, 5],
            },
            {
                text: 'Fecha de la Factura: ' + escapeSpecialCharacters('{{ htmlspecialchars_decode($factura->fecha_factura) }}'),
                margin: [0, 5],
            },
            {
                text: 'Total de la Factura: ' + escapeSpecialCharacters('{{ htmlspecialchars_decode($factura->total_factura) }}'),
                margin: [0, 20],
            },
            {
                text: 'Detalles de los Productos',
                style: 'subheader',
                alignment: 'center',
                margin: [0, 10],
            },
            {
                style: 'table',
                table: {
                    widths: ['*', '*', '*', '*'],
                    body: [
                        ['Nombre del Producto', 'Precio del Producto', 'Stock del Producto', 'Total Individual'],
                        @foreach($detallesFactura as $detalle)[
                            escapeSpecialCharacters('{{ htmlspecialchars_decode($detalle->nombre_producto) }}'),
                            escapeSpecialCharacters('{{ htmlspecialchars_decode($detalle->precio_producto) }}'),
                            escapeSpecialCharacters('{{ htmlspecialchars_decode($detalle->stock_producto) }}'),
                            escapeSpecialCharacters('{{ htmlspecialchars_decode($detalle->precio_producto * $detalle->stock_producto) }}'),
                        ],
                        @endforeach
                    ],
                },
                margin: [0, 10],
            },
        ],
        styles: {
            header: {
                fontSize: 18,
                bold: true,
            },
            subheader: {
                fontSize: 14,
                bold: true,
            },
            table: {
                margin: [0, 5, 0, 15],
            },
        },
    };

    // Generar el PDF y abrirlo en una nueva ventana del navegador
    pdfMake.createPdf(docDefinition).open();
});

// Función para escapar caracteres especiales en el texto
function escapeSpecialCharacters(text) {
    return text.replace(/[*\/]/g, '\\$&').replace(/&quot;/g, '"').replace(/&amp;/g, '&');
}

</script>
@endsection