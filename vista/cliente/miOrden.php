<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Verifica si hay un pedido activo, en este caso lo obtenemos de la sesión o parámetro GET
$id_pedido = $_GET['id_pedido'] ?? $_SESSION['id_pedido'] ?? 19; // Cambiar lógica de acuerdo a tu implementación

// Incluye el controlador
require_once __DIR__ . '/../../controlador/Cliente/OrdenControlador.php';

// Instancia el controlador de la orden
$controlador = new OrdenControlador();

// Obtiene los detalles de la orden usando el ID del pedido
$orden = $controlador->obtenerDetallesOrden($id_pedido);

// Si la orden no existe
if (!$orden) {
    echo "<div class='alert alert-warning text-center'>No se encontraron detalles para esta orden.</div>";
    exit;
}

// Obtiene el estado de la orden
$estadoOrden = $controlador->obtenerEstadoOrden($id_pedido);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Orden</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Detalles de Mi Orden</h2>

        <!-- Mostrar el estado de la orden -->
        <div class="alert alert-info text-center">
            Orden # <?= $id_pedido ?> | Estado de la orden: <?= htmlspecialchars($estadoOrden) ?> 
        </div>

        <!-- Si hay productos en la orden, mostrarlos en una tabla -->
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

    </br>

    <div class="container mt-5">
        <h2 class="mb-4">Formulario de Envio</h2>
        <form action="controlador.php" method="POST">
            <!-- Nombre del cliente -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa el nombre" required>
            </div>

            <!-- Tipo de pedido -->
            <div class="mb-3">
                <label class="form-label">Tipo de Pedido</label>
                <select class="form-select" id="tipo_pedido" name="tipo_pedido" onchange="mostrarCampos()" required>
                    <option value="">Selecciona una opción</option>
                    <option value="mesa">En mesa</option>
                    <option value="domicilio">A domicilio</option>
                </select>
            </div>

            <!-- Número de mesa (solo si es en mesa) -->
            <div class="mb-3 d-none" id="campo_mesa">
                <label for="numero_mesa" class="form-label">Número de Mesa</label>
                <input type="number" class="form-control" id="numero_mesa" name="numero_mesa" placeholder="Ingresa el número de mesa">
            </div>

            <!-- Dirección de entrega y tipo de pago (solo si es a domicilio) -->
            <div id="campo_domicilio" class="d-none">
                <div class="mb-3">
                    <label for="direccion" class="form-label">Dirección de Entrega</label>
                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Ingresa la dirección">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo de Pago</label>
                    <select class="form-select" id="tipo_pago" name="tipo_pago">
                        <option value="">Selecciona una opción</option>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="efectivo">Efectivo</option>
                    </select>
                </div>
            </div>

            <!-- Botón enviar -->
            <button type="submit" class="btn btn-primary">Enviar Pedido</button>
        </form>
    </div>

    <script>
        function mostrarCampos() {
            const tipoPedido = document.getElementById('tipo_pedido').value;
            const campoMesa = document.getElementById('campo_mesa');
            const campoDomicilio = document.getElementById('campo_domicilio');

            // Mostrar/ocultar campos según el tipo de pedido
            if (tipoPedido === 'mesa') {
                campoMesa.classList.remove('d-none');
                campoDomicilio.classList.add('d-none');
            } else if (tipoPedido === 'domicilio') {
                campoMesa.classList.add('d-none');
                campoDomicilio.classList.remove('d-none');
            } else {
                campoMesa.classList.add('d-none');
                campoDomicilio.classList.add('d-none');
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>
