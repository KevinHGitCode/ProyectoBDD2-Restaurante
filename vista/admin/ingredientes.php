<?php
require_once __DIR__.'/../../controlador/Admin/ctlIngredientes.php';
?>

<!DOCTYPE html>
<html lang="en">
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
                // Ingredientes predefinidos
                $ingredientes = [
                    ['id_ingrediente' => 1, 'nom_ingrediente' => 'Carne de Res', 'disponibilidad' => 1],
                    ['id_ingrediente' => 2, 'nom_ingrediente' => 'Pan', 'disponibilidad' => 0],
                    ['id_ingrediente' => 3, 'nom_ingrediente' => 'Lechuga', 'disponibilidad' => 1],
                    ['id_ingrediente' => 4, 'nom_ingrediente' => 'Tomate', 'disponibilidad' => 1],
                    ['id_ingrediente' => 5, 'nom_ingrediente' => 'Queso Mozzarella', 'disponibilidad' => 1],
                    ['id_ingrediente' => 6, 'nom_ingrediente' => 'Salsa Especial', 'disponibilidad' => 1],
                    ['id_ingrediente' => 7, 'nom_ingrediente' => 'Salsa de Tomate', 'disponibilidad' => 1],
                    ['id_ingrediente' => 8, 'nom_ingrediente' => 'Albahaca', 'disponibilidad' => 1],
                    ['id_ingrediente' => 9, 'nom_ingrediente' => 'Pollo', 'disponibilidad' => 1],
                    ['id_ingrediente' => 10, 'nom_ingrediente' => 'Tortilla de Maíz', 'disponibilidad' => 1],
                    ['id_ingrediente' => 11, 'nom_ingrediente' => 'Guacamole', 'disponibilidad' => 1],
                    ['id_ingrediente' => 12, 'nom_ingrediente' => 'Crutones', 'disponibilidad' => 1],
                    ['id_ingrediente' => 13, 'nom_ingrediente' => 'Queso Parmesano', 'disponibilidad' => 1],
                    ['id_ingrediente' => 14, 'nom_ingrediente' => 'Aderezo César', 'disponibilidad' => 1],
                    ['id_ingrediente' => 15, 'nom_ingrediente' => 'Pavo', 'disponibilidad' => 1],
                    ['id_ingrediente' => 16, 'nom_ingrediente' => 'Pasta', 'disponibilidad' => 1],
                    ['id_ingrediente' => 17, 'nom_ingrediente' => 'Salsa Alfredo', 'disponibilidad' => 1],
                    ['id_ingrediente' => 18, 'nom_ingrediente' => 'Mango', 'disponibilidad' => 1],
                    ['id_ingrediente' => 19, 'nom_ingrediente' => 'Café', 'disponibilidad' => 1],
                    ['id_ingrediente' => 20, 'nom_ingrediente' => 'Leche', 'disponibilidad' => 1],
                    ['id_ingrediente' => 21, 'nom_ingrediente' => 'Helado de Vainilla', 'disponibilidad' => 1],
                    ['id_ingrediente' => 22, 'nom_ingrediente' => 'Brownie', 'disponibilidad' => 1],
                ];

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
