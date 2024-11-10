<?php
//session_start(); // Asegúrate de iniciar la sesión aquí

include "../config/db.php"; 

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$conn = $database->connect();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT id_usuario, id_rol, nombre_usuario, contrasena FROM Usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifica que la contraseña coincide
        if (password_verify($password, $row['contrasena'])) { 
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['id_rol'] = $row['id_rol'];
            $_SESSION['nombre_usuario'] = $row['nombre_usuario'];

            // Redirecciona al controlador de vistas
            require_once './ctlTipoVista.php';
            $ctv = new ctlTipoVista();
            $ctv->mostrarVista();
            //echo "Se inició sesión correctamente";
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
    $stmt->close();
}

$conn->close();