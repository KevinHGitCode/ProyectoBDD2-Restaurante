<?php

//Se inicia la conexión
include "../config/db.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Consulta para verificar el usuario
    $sql = "SELECT id_usuario, id_rol, nombre_usuario, contrasena FROM Usuarios WHERE nombre_usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Comprobar si se encontró el usuario
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña
        if ($password == $row['contrasena']) { 
            // Guardar la información en la sesión
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['id_rol'] = $row['id_rol'];
            $_SESSION['nombre_usuario'] = $row['nombre_usuario'];

            // Redirigir al usuario a la página de inicio
            require_once './ctlTipoVista.php';
            $ctv = new ctlTipoVista();
            $ctv->mostrarVista();
        } else {
            // Contraseña incorrecta
            echo "Contraseña incorrecta.";
        }
    } else {
        // Usuario no encontrado
        echo "Usuario no encontrado.";
    }
    $stmt->close();
}
//Se cierra la conexión
$conn->close();