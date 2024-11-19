<?php
require_once __DIR__.'/../../controlador/Admin/ctlIngredientes.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Ingredientes</title>
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
        <h1 class="text-center mb-4">Gestión de Ingredientes</h1>

        <!-- Mostrar mensajes -->
        <?php if (isset($_GET['mensaje'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_GET['mensaje']) ?></div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
        <?php endif; ?>

        <!-- Formulario para crear un nuevo ingrediente -->
        <div class="card mb-4">
            <div class="card-body">
                <form action="ingredientes.php" method="POST" class="row g-3">
                    <div class="col-md-8">
                        <input type="text" class="form-control" name="nom_ingrediente" placeholder="Nombre del ingrediente" required>
                    </div>
                    <div class="col-md-4 d-grid">
                        <button type="submit" name="crear" class="btn btn-primary">Crear Ingrediente</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla para listar ingredientes -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Disponibilidad</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($ingredientes as $ingrediente) {
                    $toggleClass = $ingrediente['disponibilidad'] ? 'btn-success' : 'btn-secondary';
                    $toggleText = $ingrediente['disponibilidad'] ? 'Disponible' : 'No Disponible';
                    echo "<tr>
                            <td>{$ingrediente['id_ingrediente']}</td>
                            <td>
                                <div class='action-container'>
                                    <form action='ingredientes.php' method='POST'>
                                        <input type='hidden' name='id_ingrediente' value='{$ingrediente['id_ingrediente']}'>
                                        <input type='text' name='nom_ingrediente' value='{$ingrediente['nom_ingrediente']}' class='form-control form-control-sm' required>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <form action='ingredientes.php' method='POST'>
                                    <input type='hidden' name='id_ingrediente' value='{$ingrediente['id_ingrediente']}'>
                                    <button type='submit' name='toggle_disponibilidad' class='btn $toggleClass btn-sm'>$toggleText</button>
                                </form>
                            </td>
                            <td>
                                <div class='action-container'>
                                    <!-- Botón Actualizar -->
                                    <form action='ingredientes.php' method='POST'>
                                        <input type='hidden' name='id_ingrediente' value='{$ingrediente['id_ingrediente']}'>
                                        <button type='submit' name='actualizar' class='btn btn-warning btn-sm'>Actualizar</button>
                                    </form>
                                    <!-- Botón Eliminar -->
                                    <form action='ingredientes.php' method='POST'>
                                        <input type='hidden' name='id_ingrediente' value='{$ingrediente['id_ingrediente']}'>
                                        <button type='submit' name='eliminar' class='btn btn-danger btn-sm'>Eliminar</button>
                                    </form>
                                </div>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
