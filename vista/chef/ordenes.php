<div class="container mt-4">
    <h1 class="text-center mb-4">Órdenes Pendientes</h1>
    <div class="orders-wrapper">
        <?php if (count($ordenes) > 0): ?>
            <?php foreach ($ordenes as $orden): ?>
                <div class="card mb-3">
                    <div class="card-header text-center font-weight-bold">
                        Orden #<?= htmlspecialchars($orden['id_pedido']) ?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Cliente ID: <?= htmlspecialchars($orden['id_cliente']) ?></h5>
                        <p class="card-text">Plato: <?= htmlspecialchars($orden['nom_producto']) ?></p>
                        <p class="card-text">Estado actual: <?= htmlspecialchars($orden['estado']) ?></p>
                        <form method="POST" action="../../controlador/ctlChef.php">
                            <div class="form-group">
                                <label for="estado_<?= $orden['id_pedido'] ?>">Cambiar estado:</label>
                                <select class="form-control" name="estado" id="estado_<?= $orden['id_pedido'] ?>">
                                    <option value="En Cola" <?= $orden['estado'] === 'En Cola' ? 'selected' : '' ?>>En Cola</option>
                                    <option value="En Preparación" <?= $orden['estado'] === 'En Preparación' ? 'selected' : '' ?>>En Preparación</option>
                                    <option value="Completado" <?= $orden['estado'] === 'Completado' ? 'selected' : '' ?>>Completado</option>
                                </select>
                            </div>
                            <input type="hidden" name="id_pedido" value="<?= htmlspecialchars($orden['id_pedido']) ?>">
                            <button type="submit" class="btn btn-primary">Actualizar Estado</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">No hay órdenes pendientes en este momento.</p>
        <?php endif; ?>
    </div>
</div>