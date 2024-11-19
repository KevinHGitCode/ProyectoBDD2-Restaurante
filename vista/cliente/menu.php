<?php
require_once '../../controlador/ctlMenu.php'; // Incluye el controlador para manejar los datos
require_once '../../modelo/Cliente.php'; // Incluye la clase Cliente

// Obtiene el menú completo, organizado por categorías
$categorias = obtenerMenuOrganizadoPorCategoria();

if (isset($_GET['id_producto'])) {
    $id_producto = htmlspecialchars($_GET['id_producto']);

    // Verifica si existe un pedido en la sesión
    if (!isset($_SESSION['id_pedido'])) {
        // Si no existe, crea un nuevo pedido usando la clase Cliente
        $clienteModel = new Cliente();
        $id_cliente = $_SESSION['id_cliente'] ?? 1; // Usa un ID de cliente (puedes adaptarlo según tu lógica)
        $id_mesa = $_SESSION['id_mesa'] ?? null;   // Puedes usar null o una mesa específica

        // Llama a la función para crear un nuevo pedido y guarda el ID del pedido en la sesión
        $id_pedido = $clienteModel->crearPedido($id_cliente, $id_mesa);
        if ($id_pedido) {
            $_SESSION['id_pedido'] = $id_pedido;
        } else {
            echo "
                <div class='alert alert-danger text-center mb-0' role='alert'>
                    No se pudo crear el pedido. Intente nuevamente.
                </div>
            ";
            exit;
        }
    } else {
        // Si ya existe, usa el ID del pedido actual
        $id_pedido = $_SESSION['id_pedido'];
    }

    // Agrega el producto al pedido actual
    $clienteModel = new Cliente();
    $producto = ['id_producto' => $id_producto, 'accion' => 'Añadir']; // Configura los datos del producto
    $resultado = $clienteModel->agregarProductosAPedido($id_pedido, [$producto]);

    if ($resultado) {
        echo "
            <div class='alert alert-success text-center mb-0' role='alert'>
                Se añadió el producto con ID $id_producto a la orden.
            </div>
        ";
    } else {
        echo "
            <div class='alert alert-danger text-center mb-0' role='alert'>
                No se pudo añadir el producto a la orden. Intente nuevamente.
            </div>
        ";
    }
}
?>

<style>
    body {
        background-color: #FAF3E0; /* Fondo crema suave */
        color: #2A6041; /* Color del texto general */
    }
    
    .titulo-categoria {
        color: #2A6041; /* Verde bosque */
        font-weight: bold; /* Hace que el texto sea más destacado */
    }
</style>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Nuestro Menú</h1>
        <?php foreach ($categorias as $categoria => $platos): ?>
            <h2 class="my-4 titulo-categoria"><?= htmlspecialchars($categoria) ?></h2>
            <div class="row">
                <?php foreach ($platos as $plato): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            <!-- LÍNEA MODIFICADA: Usa el enlace de imagen desde la base de datos -->
                            <img src="<?= htmlspecialchars($plato['link_img']) ?>" 
                                 class="card-img-top" 
                                 alt="<?= htmlspecialchars($plato['nom_producto']) ?>" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body custom-card-body">
                                <h5 class="card-title font-weight-bold"><?= htmlspecialchars($plato['nom_producto']) ?></h5>
                                <!-- LÍNEA NUEVA: Incluye la descripción del producto -->
                                <p class="card-text" style= "color: black"><?= htmlspecialchars($plato['descripcion']) ?></p>
                                <p class="card-text" style= "color: black">Precio: $<?= number_format($plato['precio'], 2) ?></p>
                                <a href="?id_producto=<?= urlencode($plato['id_producto']) ?>" 
                                    class="btn btn-block" 
                                    style="color: #FAE3D9; background-color: #2A6041;">
                                    Añadir a su orden
                                </a> 
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
