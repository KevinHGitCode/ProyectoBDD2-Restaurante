<?php
require_once 'config/db.php';

class User {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Método para registrar un nuevo usuario
    public function register($username, $email, $password) {
        // Encriptar la contraseña
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        
        // Definir el rol de cliente
        $id_rol = 1; // ID para rol de cliente
        
        // Preparar la consulta SQL
        $stmt = $this->conn->prepare("INSERT INTO Usuarios (nombre_usuario, email, contrasena, id_rol) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sssi", $username, $email, $hashedPassword, $id_rol);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }
}
?>
