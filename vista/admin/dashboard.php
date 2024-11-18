<?php
// dashboard.php
?>

<div class="container-fluid">
    <div class="row">
        <!-- Título del Dashboard -->
        <div class="col-12 mt-4">
            <h1 class="h2">Panel de Administración</h1>
            <p class="text-muted">Resumen general del sistema</p>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Usuarios Registrados</h5>
                    <p class="card-text">15</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Productos en Inventario</h5>
                    <p class="card-text">120</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Pedidos Pendientes</h5>
                    <p class="card-text">8</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfico de ventas recientes -->
    <div class="row mt-4">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">Ventas Recientes</div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Top Productos</div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Producto A - 30 vendidos</li>
                        <li class="list-group-item">Producto B - 25 vendidos</li>
                        <li class="list-group-item">Producto C - 20 vendidos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Configuración del gráfico
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Ventas Semanales',
                data: [12, 19, 3, 5, 2, 3, 7],
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.3,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        }
    });
</script>
