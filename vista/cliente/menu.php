<?php
require_once '../../controlador/ctlMenu.php'; // Incluye el controlador para manejar los datos

// Obtiene el menú completo, organizado por categorías
$categorias = obtenerMenuOrganizadoPorCategoria();

?>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Nuestro Menú</h1>
        <?php foreach ($categorias as $categoria => $platos): ?>
            <h2 class="my-4 text-primary"><?= htmlspecialchars($categoria) ?></h2>
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
                                <p class="card-text"><?= htmlspecialchars($plato['descripcion']) ?></p>
                                <p class="card-text">Precio: $<?= number_format($plato['precio'], 2) ?></p>
                                <a href="#" class="btn btn-outline-primary btn-block">Añadir a su orden</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
