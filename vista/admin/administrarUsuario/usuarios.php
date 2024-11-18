<?php
require_once '../../controlador/ctlAdminUsuarios.php';

// Obtener la lista de usuarios para la tabla
$usuarios = obtenerUsuarios();
?>

<div class="container mt-4">
    <h1>Administrar Usuarios</h1>
    <button class="btn btn-primary mb-3" onclick="mostrarFormularioCrear()">Crear Usuario</button>

    <!-- Tabla de usuarios -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaUsuariosBody">
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id_usuario'] ?></td>
                    <td><?= $usuario['nombre_usuario'] ?></td>
                    <td><?= $usuario['email'] ?></td>
                    <td><?= $usuario['nombre_rol'] ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="mostrarFormularioEditar(<?= $usuario['id_usuario'] ?>, '<?= $usuario['nombre_usuario'] ?>', '<?= $usuario['email'] ?>', <?= $usuario['nombre_rol'] ?>)">Editar</button>
                        <form method="POST" action="../../controlador/ctlAdminUsuarios.php" style="display:inline;">
                            <input type="hidden" name="accion" value="eliminar">
                            <input type="hidden" name="id_usuario" value="<?= $usuario['id_usuario'] ?>">
                            <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Formulario para crear o editar usuarios -->
<div id="formularioUsuario" style="display:none;">
    <form method="POST" action="../../controlador/ctlAdminUsuarios.php">
        <input type="hidden" name="accion" id="accionUsuario" value="crear">
        <input type="hidden" name="id_usuario" id="idUsuario">
        <div class="form-group">
            <label for="nombreUsuario">Nombre</label>
            <input type="text" class="form-control" name="nombre_usuario" id="nombreUsuario" required>
        </div>
        <div class="form-group">
            <label for="emailUsuario">Email</label>
            <input type="email" class="form-control" name="email" id="emailUsuario" required>
        </div>
        <div class="form-group">
            <label for="rolUsuario">Rol</label>
            <select class="form-control" name="id_rol" id="rolUsuario" required>
                <option value="1">Administrador</option>
                <option value="2">Usuario</option>
            </select>
        </div>
        <div id="campoContrasena" class="form-group">
            <label for="contrasenaUsuario">Contraseña</label>
            <input type="password" class="form-control" name="contrasena" id="contrasenaUsuario" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button type="button" class="btn btn-secondary" onclick="ocultarFormulario()">Cancelar</button>
    </form>
</div>

<script>
    function mostrarFormularioCrear() {
        document.getElementById('accionUsuario').value = 'crear';
        document.getElementById('idUsuario').value = '';
        document.getElementById('nombreUsuario').value = '';
        document.getElementById('emailUsuario').value = '';
        document.getElementById('rolUsuario').value = '';
        document.getElementById('campoContrasena').style.display = 'block';
        document.getElementById('formularioUsuario').style.display = 'block';
    }

    function mostrarFormularioEditar(id, nombre, email, rol) {
        document.getElementById('accionUsuario').value = 'actualizar';
        document.getElementById('idUsuario').value = id;
        document.getElementById('nombreUsuario').value = nombre;
        document.getElementById('emailUsuario').value = email;
        document.getElementById('rolUsuario').value = rol;
        document.getElementById('campoContrasena').style.display = 'none';
        document.getElementById('formularioUsuario').style.display = 'block';
    }

    function ocultarFormulario() {
        document.getElementById('formularioUsuario').style.display = 'none';
    }
</script>
