<!-- <?php
require_once __DIR__.'/../../controlador/Admin/ctlMiOrden.php';

// Simulamos un cliente logueado con un ID fijo (esto normalmente se obtiene de la sesión)
session_start();
$id_cliente = $_SESSION['id_cliente'] ?? 1; // Cambiar según tu lógica de autenticación

// Instanciar el controlador y obtener la orden
$controlador = new OrdenControlador();
$orden = $controlador->obtenerOrdenPorCliente($id_cliente);
?> -->

<?php
// Simulamos un cliente logueado con un ID fijo
session_start();
$id_cliente = $_SESSION['id_cliente'] ?? 1; // Cambiar según tu lógica de autenticación

// Datos de prueba que simulan una orden
$orden = [
    'productos' => [
        [
            'id_producto' => 1,
            'nom_producto' => 'Pizza Margarita',
            'cantidad' => 2,
            'precio' => 12.50,
            'subtotal' => 25.00
        ],
        [
            'id_producto' => 2,
            'nom_producto' => 'Ensalada César',
            'cantidad' => 1,
            'precio' => 8.00,
            'subtotal' => 8.00
        ],
        [
            'id_producto' => 3,
            'nom_producto' => 'Limonada',
            'cantidad' => 3,
            'precio' => 3.50,
            'subtotal' => 10.50
        ]
    ],
    'total' => 43.50
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Orden</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Detalles de Mi Orden</h2>
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orden['productos'] as $producto): ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nom_producto']) ?></td>
                        <td><?= $producto['cantidad'] ?></td>
                        <td>$<?= number_format($producto['precio'], 2) ?></td>
                        <td>$<?= number_format($producto['subtotal'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3" class="text-right">Total:</th>
                    <th>$<?= number_format($orden['total'], 2) ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>

