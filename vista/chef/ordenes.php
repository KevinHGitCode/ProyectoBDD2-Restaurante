<div class="container mt-4">
    <!-- Contenedor con desplazamiento horizontal -->
    <div class="orders-wrapper overflow-auto">
        <!-- Orden 1 -->
        <div class="card">
            <div class="card-header text-center font-weight-bold">
                Orden #12345
            </div>
            <div class="card-body">
                <h5 class="card-title">Cliente: Juan Pérez</h5>
                <p class="card-text">Plato: Pizza Margarita</p>
                <p class="card-text">Cantidad: 2</p>
                <p class="card-text">Comentarios: Sin cebolla</p>
                <div class="form-group">
                    <label for="orderStatus">Estado:</label>
                    <select class="form-control" id="orderStatus">
                        <option value="queue">En cola</option>
                        <option value="preparation">En preparación</option>
                        <option value="completed">Completado</option>
                    </select>
                </div>
            </div>
            <div class="card-footer text-muted text-center">
                Fecha: 2024-11-13
            </div>
        </div>

    </div>
</div>
