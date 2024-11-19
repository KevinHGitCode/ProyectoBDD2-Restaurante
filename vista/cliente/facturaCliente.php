<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura del Cliente</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .invoice-header {
            background-color: #004085; /* Azul oscuro */
            color: white; /* Letras blancas */
            padding: 20px;
            border-radius: 5px;
            border: 3px solid #87ceeb; /* Borde azul claro */
        }
        .invoice-details {
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background-color: white;
            padding: 20px;
            margin-top: 20px;
        }
        .total-section {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <!-- Encabezado de la factura -->
        <div class="invoice-header text-center mb-4">
            <h1>Factura</h1>
            <p class="mb-0">Número de factura: <strong>#001234</strong></p>
            <p>Fecha: <strong>2024-11-19</strong></p>
        </div>

        <!-- Información del cliente -->
        <div class="row">
            <div class="col-md-6">
                <div class="invoice-details">
                    <h5>Información del Cliente</h5>
                    <p>Nombre: <strong>Juan Pérez</strong></p>
                    <p>Correo: <strong>juan.perez@example.com</strong></p>
                    <p>Teléfono: <strong>+57 300 123 4567</strong></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="invoice-details">
                    <h5>Método de Pago</h5>
                    <p><strong>Tarjeta de Crédito</strong></p>
                </div>
            </div>
        </div>

        <!-- Tabla de productos -->
        <div class="invoice-details mt-4">
            <h5>Productos Comprados</h5>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Mouse de Chocolate</td>
                        <td>2</td>
                        <td>$12,000 COP</td>
                        <td>$24,000 COP</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Sopa de Pollo Gourmet</td>
                        <td>1</td>
                        <td>$25,000 COP</td>
                        <td>$25,000 COP</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Sección de total -->
        <div class="total-section text-end mt-3">
            <h4>Total a Pagar: <strong>$49,000 COP</strong></h4>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
