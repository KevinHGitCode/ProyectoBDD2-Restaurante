<?php
require_once 'modelo/User.php';

class ctlAutenticacion {
    public function registerUser() {
        // Verificar si el formulario fue enviado
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recoger datos del formulario
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];

            // Verificar que las contraseñas coinciden
            if ($password !== $confirmPassword) {
                echo "Las contraseñas no coinciden.";
                return;
            }

            // Crear una instancia del modelo User y registrar el usuario
            $userModel = new User();
            if ($userModel->register($username, $email, $password)) {
                // Registro exitoso, redirigir al login o a la página de inicio
                header("Location: index.php?vista=pagina_principal/home");
            } else {
                echo "Error en el registro. Intente nuevamente.";
            }
        }
    }
}

// Llamada al método registerUser si se accede desde el formulario de registro
$controlador = new ctlAutenticacion();
$controlador->registerUser();
?>
