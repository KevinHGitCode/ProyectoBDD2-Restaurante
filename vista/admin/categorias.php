<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Categorías</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .action-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .action-container form {
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Gestión de Categorías</h1>

        <!-- Formulario para crear una nueva categoría -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="categorias.php" method="POST" class="row g-3">
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="nom_categoria" placeholder="Nombre de la categoría" required>
                    </div>
                    <div class="col-md-4 d-grid">
                        <button type="submit" name="crear" class="btn btn-primary">Crear Categoría</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla para listar categorías -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Categorías -->
                <tr>
                    <td>1</td>
                    <td>
                        <div class="action-container">
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="1">
                                <input type="text" name="nom_categoria" value="Entrada" class="form-control form-control-sm" required>
                            </form>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="1">
                                <button type="submit" name="actualizar" class="btn btn-warning btn-sm">Editar</button>
                            </form>
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="1">
                                <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <div class="action-container">
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="2">
                                <input type="text" name="nom_categoria" value="Platos Principales" class="form-control form-control-sm" required>
                            </form>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="2">
                                <button type="submit" name="actualizar" class="btn btn-warning btn-sm">Editar</button>
                            </form>
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="2">
                                <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <div class="action-container">
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="3">
                                <input type="text" name="nom_categoria" value="Postres" class="form-control form-control-sm" required>
                            </form>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="3">
                                <button type="submit" name="actualizar" class="btn btn-warning btn-sm">Editar</button>
                            </form>
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="3">
                                <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>
                        <div class="action-container">
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="4">
                                <input type="text" name="nom_categoria" value="Bebidas" class="form-control form-control-sm" required>
                            </form>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="4">
                                <button type="submit" name="actualizar" class="btn btn-warning btn-sm">Editar</button>
                            </form>
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="4">
                                <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>
                        <div class="action-container">
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="5">
                                <input type="text" name="nom_categoria" value="Aperitivos" class="form-control form-control-sm" required>
                            </form>
                        </div>
                    </td>
                    <td>
                        <div class="action-container">
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="5">
                                <button type="submit" name="actualizar" class="btn btn-warning btn-sm">Editar</button>
                            </form>
                            <form action="categorias.php" method="POST">
                                <input type="hidden" name="id_categoria" value="5">
                                <button type="submit" name="eliminar" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
