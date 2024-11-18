<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar">
            <div class="sidebar-sticky pt-3">

                <h5 class="text-white text-center">
                    <a href="?page=dashboard" class="text-white text-decoration-none">Admin Panel</a>
                </h5>

                <ul class="nav flex-column">
                    <!-- Opciones CRUD -->
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?page=usuarios">Usuarios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?page=productos">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?page=categorias">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="?page=ingredientes">Ingredientes</a>
                    </li>
                    <!-- Submenú para Reportes -->
                    <li class="nav-item">
                        <a class="nav-link text-white" data-toggle="collapse" href="#reportesMenu" role="button" aria-expanded="false" aria-controls="reportesMenu">
                            Reportes
                        </a>
                        <div class="collapse" id="reportesMenu">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link-sub text-white" href="?page=reportes_facturas">Facturas</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-sub text-white" href="?page=reportes_productos">Productos</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link-sub text-white" href="?page=reportes_clientes">Clientes</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- Cerrar sesión -->
                    <li class="nav-item">
                        <a class="nav-link text-white logout" href="../../controlador/ctlLogout.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </nav>

        
    </div>
</div>