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

    // Verifica si se encontraron resultados
    // if ($result->num_rows > 0) {
    //     // Muestra los resultados
    //     while ($row = $result->fetch_assoc()) {
    //         echo "ID Usuario: " . $row['id_usuario'] . "<br>";
    //         echo "ID Rol: " . $row['id_rol'] . "<br>";
    //         echo "Nombre Usuario: " . $row['nombre_usuario'] . "<br>";
    //         echo "Contraseña: " . $row['contrasena'] . "<br>";
    //         echo "<hr>"; // Separador para los resultados
    //     }
    // } else {
    //     echo "No se encontraron resultados.";
    // }

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // contrasena123
        // Verifica que la contraseña coincide
        if ($password == $row['contrasena']) { 
            $_SESSION['id_usuario'] = $row['id_usuario'];
            $_SESSION['id_rol'] = $row['id_rol'];
            $_SESSION['nombre_usuario'] = $row['nombre_usuario'];
            
//            echo var_dump($_SESSION['id_rol']);
            
            // Redirecciona al controlador de vistas
            require './ctlTipoVista.php';
            $ctv = new ctlTipoVista();
            $ctv->mostrarVista();
            echo "Se inició sesión correctamente";
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
    $stmt->close();
}

$conn->close();