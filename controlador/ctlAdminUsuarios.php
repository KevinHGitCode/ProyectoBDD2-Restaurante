<?php
require_once __DIR__.'../../modelo/Admin.php';

function obtenerUsuarios() {
    $admin = new Admin();
    return $admin->obtenerUsuarios();
}

function crearUsuario($nombre_usuario, $email, $contrasena, $id_rol) {
    $admin = new Admin();
    return $admin->crearUsuario($nombre_usuario, $email, $contrasena, $id_rol);
}

function eliminarUsuario($id_usuario) {
    $admin = new Admin();
    return $admin->eliminarUsuario($id_usuario);
}

function actualizarUsuario($id_usuario, $nombre_usuario, $email, $id_rol) {
    $admin = new Admin();
    return $admin->actualizarUsuario($id_usuario, $nombre_usuario, $email, $id_rol);
}

// Manejar las solicitudes desde la vista
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];

    switch ($accion) {
        case 'crear':
            $nombre_usuario = $_POST['nombre_usuario'];
            $email = $_POST['email'];
            $contrasena = $_POST['contrasena'];
            $id_rol = $_POST['id_rol'];
            echo crearUsuario($nombre_usuario, $email, $contrasena, $id_rol);
            break;

        case 'eliminar':
            $id_usuario = $_POST['id_usuario'];
            echo eliminarUsuario($id_usuario);
            break;

        case 'actualizar':
            $id_usuario = $_POST['id_usuario'];
            $nombre_usuario = $_POST['nombre_usuario'];
            $email = $_POST['email'];
            $id_rol = $_POST['id_rol'];
            echo actualizarUsuario($id_usuario, $nombre_usuario, $email, $id_rol);
            break;

        default:
            echo "Acción no válida.";
    }
}

// Obtener usuarios para la tabla
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accion']) && $_GET['accion'] === 'obtener') {
    echo json_encode(obtenerUsuarios());
}
