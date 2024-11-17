<?php
require_once '../config/db.php';

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
  
    // Método para autenticar usuario
    public function authenticate($nombre_usuario, $password) {
        // Preparar la consulta SQL
        $stmt = $this->conn->prepare("SELECT id_usuario, id_rol, nombre_usuario, contrasena FROM Usuarios WHERE nombre_usuario = ?");
        $stmt->bind_param("s", $nombre_usuario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $stmt->store_result();

            // Verificar si existe un usuario con ese nombre de usuario
            if ($stmt->num_rows > 0) {
                // Vincular resultados
                $stmt->bind_result($id_usuario, $id_rol, $nombre_usuario, $hashedPassword);
                $stmt->fetch();

                // Verificar la contraseña
                if (password_verify($password, $hashedPassword)) {
                    return [
                        "id_usuario" => $id_usuario,
                        "id_rol" => $id_rol,
                        "nombre_usuario" => $nombre_usuario
                    ];
                } else {
                    return "Contraseña incorrecta."; // Retornar un mensaje en caso de error
                }
            } else {
                return "Usuario no encontrado."; // Retornar mensaje si no se encuentra el usuario
            }
        }

        // Manejo de errores si la consulta falla
        return "Error en la consulta.";
    }



    // Método para actualizar contraseña
    public function updatePassword($id_usuario, $newPassword) {
        // Encriptar la nueva contraseña
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Preparar la consulta SQL
        $stmt = $this->conn->prepare("UPDATE Usuarios SET contrasena = ? WHERE id_usuario = ?");
        $stmt->bind_param("si", $hashedPassword, $id_usuario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }



    // Método para actualizar nombre de usuario
    public function updateUsername($id_usuario, $newUsername) {
        // Preparar la consulta SQL
        $stmt = $this->conn->prepare("UPDATE Usuarios SET nombre_usuario = ? WHERE id_usuario = ?");
        $stmt->bind_param("si", $newUsername, $id_usuario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }



    // Método para eliminar usuario
    public function deleteUser($id_usuario) {
        // Preparar la consulta SQL
        $stmt = $this->conn->prepare("DELETE FROM Usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }



    // Método para obtener datos de un usuario
    public function getUserData($id_usuario) {
        // Preparar la consulta SQL
        $stmt = $this->conn->prepare("SELECT id_usuario, nombre_usuario, email, id_rol FROM Usuarios WHERE id_usuario = ?");
        $stmt->bind_param("i", $id_usuario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                return $result->fetch_assoc(); // Retornar los datos del usuario
            }
        }
        
        $stmt->close();
        return false; // Usuario no encontrado
    }




}
