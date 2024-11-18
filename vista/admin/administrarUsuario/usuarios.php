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
                        <button class="btn btn-warning btn-sm" onclick="editarUsuario(<?= $usuario['id_usuario'] ?>)">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="eliminarUsuario(<?= $usuario['id_usuario'] ?>)">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    
    
</div>

