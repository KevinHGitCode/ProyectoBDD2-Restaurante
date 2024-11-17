<?php
require_once '../../modelo/Admin.php'; 

$admin = new Admin();
$usuarios = $admin->obtenerUsuarios();

// Verificar si $usuarios es un arreglo válido
if (!$usuarios) {
    $usuarios = []; // Si no se encuentran usuarios, asignar un arreglo vacío
}
?>

<div class="container mt-4">
    <h1>Administrar Usuarios</h1>
    <button class="btn btn-primary mb-3" onclick="mostrarFormulario()">Crear Usuario</button>

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
                        <button class="btn btn-warning btn-sm" onclick="editarUsuario(<?= $usuario['id_usuario'] ?>)">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarUsuario(<?= $usuario['id_usuario'] ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Formulario de creación/edición -->
    <div id="formularioUsuario" style="display: none;">
        <h2 id="formularioTitulo">Crear Usuario</h2>
        <form id="usuarioForm">
            <input type="hidden" name="action" id="action" value="crear">
            <input type="hidden" name="id_usuario" id="id_usuario">
            <div class="form-group">
                <label for="nombre_usuario">Nombre</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="id_rol">Rol</label>
                <select class="form-control" id="id_rol" name="id_rol" required>
                    <option value="3">Administrador</option>
                    <option value="2">Chef</option>
                    <option value="1">Cliente</option>
                </select>
            </div>
            <div class="form-group" id="passwordGroup">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" id="contrasena" name="contrasena" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="button" class="btn btn-secondary" onclick="ocultarFormulario()">Cancelar</button>
        </form>
    </div>
</div>

<script>
    // Mostrar el formulario para crear usuario
    function mostrarFormulario() {
        resetFormulario();
        document.getElementById('formularioUsuario').style.display = 'block';
        document.getElementById('formularioTitulo').innerText = 'Crear Usuario';
    }

    // Ocultar el formulario de usuario
    function ocultarFormulario() {
        document.getElementById('formularioUsuario').style.display = 'none';
    }

    // Resetear el formulario
    function resetFormulario() {
        document.getElementById('usuarioForm').reset();
        document.getElementById('passwordGroup').style.display = 'block';
        document.getElementById('action').value = 'crear';
    }

    // Editar usuario
    function editarUsuario(id) {
        fetch(`../../controlador/ctlUsuario.php?action=obtener&id=${id}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('id_usuario').value = data.id_usuario;
                document.getElementById('nombre_usuario').value = data.nombre_usuario;
                document.getElementById('email').value = data.email;
                document.getElementById('id_rol').value = data.id_rol;
                document.getElementById('formularioUsuario').style.display = 'block';
                document.getElementById('passwordGroup').style.display = 'none';
                document.getElementById('formularioTitulo').innerText = 'Editar Usuario';
                document.getElementById('action').value = 'actualizar';
            });
    }

    // Eliminar usuario
    function eliminarUsuario(id) {
        if (confirm('¿Estás seguro de eliminar este usuario?')) {
            fetch(`../../controlador/ctlUsuario.php?action=eliminar&id=${id}`)
                .then(() => {
                    Swal.fire('Usuario eliminado', '', 'success');
                    mostrarUsuarios(); // Recargar la tabla
                })
                .catch(() => {
                    Swal.fire('Error', 'No se pudo eliminar el usuario', 'error');
                });
        }
    }

    // Enviar formulario con AJAX
    document.getElementById('usuarioForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('../../controlador/ctlUsuario.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            Swal.fire({
                title: data.success ? 'Éxito' : 'Error',
                text: data.message,
                icon: data.success ? 'success' : 'error',
                confirmButtonText: 'OK',
            });

            if (data.success) {
                mostrarUsuarios(); // Recargar la tabla
                ocultarFormulario();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Ocurrió un error. Intenta nuevamente.', 'error');
        });
    });

    // Función para cargar los usuarios (actualizar tabla)
    function mostrarUsuarios() {
        fetch('../../controlador/ctlUsuario.php?action=listar')
            .then(response => response.json())
            .then(data => {
                const tablaBody = document.getElementById('tablaUsuariosBody');
                tablaBody.innerHTML = ''; // Limpiar tabla
                data.forEach(usuario => {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td>${usuario.id_usuario}</td>
                        <td>${usuario.nombre_usuario}</td>
                        <td>${usuario.email}</td>
                        <td>${usuario.nombre_rol}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="editarUsuario(${usuario.id_usuario})">Editar</button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarUsuario(${usuario.id_usuario})">Eliminar</button>
                        </td>
                    `;
                    tablaBody.appendChild(row);
                });
            });
    }
</script>
