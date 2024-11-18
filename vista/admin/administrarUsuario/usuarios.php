<?php
require_once __DIR__.'/../../../modelo/Admin.php';

// Crear una instancia de Admin para acceder a los métodos
$admin = new Admin();
$usuarios = [];

// Manejar la búsqueda de usuarios
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['busqueda'])) {
    $busqueda = htmlspecialchars(strip_tags($_POST['busqueda'])); // Sanitizar el término de búsqueda
    $usuarios = $admin->buscarUsuarios($busqueda);
} else {
    $usuarios = $admin->obtenerUsuarios();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuarios</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Administración de Usuarios</h1>

    <!-- Mostrar mensajes -->
    <?php if (isset($_GET['mensaje'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['mensaje']) ?></div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_GET['error']) ?></div>
    <?php endif; ?>

    <!-- Barra de búsqueda -->
    <form method="POST" class="mb-4">
        <div class="input-group">
            <input type="text" name="busqueda" class="form-control" placeholder="Buscar usuarios..." required>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </div>
    </form>

    <!-- Tabla de usuarios -->
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php if (empty($usuarios)): ?>
            <tr>
                <td colspan="5" class="text-center">No se encontraron usuarios.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id_usuario'] ?></td>
                    <td><?= htmlspecialchars($usuario['nombre_usuario']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= htmlspecialchars($usuario['nombre_rol']) ?></td>
                    <td>
                        <!-- Botón que activa el modal -->
                        <button type="button" class="btn btn-warning btn-sm" 
                                data-bs-toggle="modal" 
                                data-bs-target="#editUserModal" 
                                data-id="<?= $usuario['id_usuario'] ?>">
                            Editar Usuario
                        </button>

                        <!-- Formulario para eliminar -->
                        <form method="POST" action="../../controlador/Admin/ctlEliminarUsuario.php" 
                                            style="display: inline;" onsubmit="return confirm('¿Está seguro de eliminar este usuario?');">
                            <input type="hidden" name="id" value="<?= $usuario['id_usuario'] ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</div>

<!-- Formulario para crear un nuevo usuario -->
<?php include __DIR__."/frmCrearUsuario.php"; ?>

<!-- Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="POST" action="../../controlador/Admin/ctlEditarUsuario.php">
                    <input type="hidden" name="id" id="id_usuario">
                    <div class="mb-3">
                        <label for="nombre_usuario" class="form-label">Nombre</label>
                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="id_rol" class="form-label">Rol</label>
                        <select name="id_rol" id="id_rol" class="form-select" required>
                            <option value="1">Admin</option>
                            <option value="2">Usuario</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const editUserModal = document.getElementById("editUserModal");

    editUserModal.addEventListener("show.bs.modal", (event) => {
        const button = event.relatedTarget; // Botón que abre el modal
        const userId = button.getAttribute("data-id");
        
        console.log(`URL de fetch: ../../controlador/Admin/ctlObtenerUsuario.php?id=${userId}`);

        fetch(`../../controlador/Admin/ctlObtenerUsuario.php?id=${userId}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then((data) => {
                if (data.error) {
                    console.error("Error en la respuesta:", data.error);
                    alert(`Error: ${data.error}`);
                    return;
                }

                // Rellenar los campos del formulario
                document.getElementById("id_usuario").value = data.id_usuario;
                document.getElementById("nombre_usuario").value = data.nombre_usuario;
                document.getElementById("email").value = data.email;
                document.getElementById("id_rol").value = data.id_rol;
            })
            .catch((error) => {
                console.error("Error al cargar los datos del usuario:", error);
                alert("Error al cargar los datos del usuario. Consulte la consola para más detalles.");
            });
    });
});
</script>

<!-- Bootstrap JS (Opcional) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>