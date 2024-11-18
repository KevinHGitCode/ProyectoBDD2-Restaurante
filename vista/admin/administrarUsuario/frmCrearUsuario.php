<?php
    include __DIR__."//../../../controlador/Admin/ctlCrearUsuario.php";
?>
<h2 class="mt-5">Crear Usuario</h2>
    <form method="POST">
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="nombre_usuario" class="form-label">Nombre</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="col-md-4">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="id_rol" class="form-label">Rol</label>
                <select name="id_rol" id="id_rol" class="form-select" required>
                    <option value="1">Admin</option>
                    <option value="2">Usuario</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Crear Usuario</button>
    </form>