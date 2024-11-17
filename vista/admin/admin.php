<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .sidebar {
            height: 100vh;
            position: fixed;
            padding-top: 20px;
        }

        .content {
            margin-left: 18rem; /* Espacio para el sidebar */
        }

        /* Estilo para las opciones del sidebar */
        .sidebar a {
            display: block;
            padding: 10px 20px;
            margin-bottom: 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
            color: white;
            font-weight: bold;
            text-decoration: none;
            background-color: #343a40; /* Fondo oscuro para las secciones */
            border: 2px solid transparent;
        }

        /* Estilo al pasar el cursor */
        .sidebar a:hover {
            color: white;
            background-color: #007bff; /* Azul Bootstrap */
            border-color: #ced4da; /* Gris claro para el borde */
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3); /* Sutil sombra azul */
            font-size: 1.1rem;
        }

        /* Estilo para el "Cerrar Sesión" */
        .logout-container {
            position: absolute;
            top: 10px;
            right: 20px;
            z-index: 10;
            padding: 5px;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.5); /* Fondo gris oscuro transparente */
        }

        .logout {
            color: white;
            font-size: 1rem;
            font-weight: bold;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .logout:hover, .logout:focus {
            background-color: #e74c3c; /* Rojo suave */
            color: white;
            font-size: 1.1rem;
        }

        /* Estilo para el submenú de Reportes */
        .collapse {
            display: none;
        }

        .collapse.show {
            display: block;
            position: relative;
            left: 0; /* No sobresalir fuera del área */
            margin-top: 0;
            padding-left: 20px; /* Separación de las subopciones */
            background-color: #343a40; /* Fondo oscuro */
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-item {
            margin-bottom: 10px; /* Separación entre las secciones principales */
        }

        .nav-item .nav-link {
            padding: 10px 20px;
            color: white;
            font-weight: bold;
            text-decoration: none;
            background-color: #343a40;
            border: 2px solid transparent;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-item .nav-link:hover {
            background-color: #007bff;
            font-size: 1.1rem;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3); /* Sombra azul */
        }

        /* Estilo para las subopciones de "Reportes" */
        .nav-item .nav-link-sub {
            padding: 10px 15px;
            color: white;
            font-weight: normal;
            background-color: transparent;
            border: none;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .nav-item .nav-link-sub:hover {
            background-color: #48C9B0; /* Azul turquesa */
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar d-flex flex-column">
                <div class="sidebar-sticky pt-3">
                    <h5 class="text-white text-center">Admin Panel</h5>
                    <ul class="nav flex-column">
                        <!-- Opciones CRUD -->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="usuarios.php">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="productos.php">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="categorias.php">Categorías</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="ingredientes.php">Ingredientes</a>
                        </li>

                        <!-- Submenú para Reportes -->
                        <li class="nav-item">
                            <a class="nav-link text-white" data-toggle="collapse" href="#reportesMenu" role="button" aria-expanded="false" aria-controls="reportesMenu">
                                Reportes
                            </a>
                            <div class="collapse" id="reportesMenu">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link-sub text-white" href="reportes_facturas.php">Facturas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link-sub text-white" href="reportes_productos.php">Productos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link-sub text-white" href="reportes_clientes.php">Clientes</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main content -->
            <main role="main" class="content col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <h1 class="h2">Bienvenido, Administrador</h1>
                <p>Seleccione una de las opciones del menú para comenzar.</p>
            </main>

            <!-- Cerrar sesión en la parte superior derecha -->
            <div class="logout-container">
                <a class="logout" href="#">Cerrar Sesión</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
