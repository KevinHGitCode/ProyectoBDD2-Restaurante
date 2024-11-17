<!DOCTYPE html>
<!-- Vista para un usuario de tipo "Administrador" -->
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<!--
1. Ver y gestionar usuarios
2. Revisar y actualizar órdenes
3. Administrar inventario
4. Generar reportes
5. Configurar ajustes del sistema
6. Ver panel de estadísticas
7. Cerrar sesión
-->


<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar" style="height: 100vh;">
                <div class="sidebar-sticky pt-3">
                    <h5 class="text-white text-center">Admin Panel</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Órdenes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Inventario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Reportes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Configuración</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">Cerrar Sesión</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <h1 class="h2">Bienvenido, Administrador</h1>
                <p>Seleccione una de las opciones del menú para comenzar.</p>
                CRUD Usuarios<br>
                CRUD Ingredientes<br>
                CRUD Categoria<br>
                CRUD Productos<br>
                Reportes de Facturas, Productos, Clientes<br>
                <!-- Aquí podrías añadir más contenido específico para cada sección -->
            </main>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

