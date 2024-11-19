<?php
// Incluir el archivo del modelo
require_once '../../modelo/Admin.php'; // Asegúrate de que el archivo ingredientes.php esté en el mismo nivel o ajusta la ruta

// Instanciar la clase del modelo
$admin = new Admin(); // Asegúrate de que la clase del modelo se llame IngredientesModel

// Procesar las solicitudes
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear ingrediente
    if (isset($_POST['crear'])) {
        $nom_ingrediente = $_POST['nom_ingrediente'];
        $disponibilidad = 1; // Por defecto, se crea como disponible
        if ($ingredientesModel->crearIngrediente($nom_ingrediente, $disponibilidad)) {
            header("Location: ingredientes.php?mensaje=creado");
        } else {
            header("Location: ingredientes.php?mensaje=error");
        }
        exit();
    }

    // Actualizar ingrediente
    if (isset($_POST['actualizar'])) {
        $id_ingrediente = $_POST['id_ingrediente'];
        $nom_ingrediente = $_POST['nom_ingrediente'];
        $disponibilidad = $_POST['disponibilidad'] ?? 1; // Por defecto, disponible
        if ($ingredientesModel->actualizarIngrediente($id_ingrediente, $nom_ingrediente, $disponibilidad)) {
            header("Location: ingredientes.php?mensaje=actualizado");
        } else {
            header("Location: ingredientes.php?mensaje=error");
        }
        exit();
    }

    // Cambiar disponibilidad
    if (isset($_POST['toggle_disponibilidad'])) {
        $id_ingrediente = $_POST['id_ingrediente'];
        $ingrediente = $ingredientesModel->obtenerIngredientePorId($id_ingrediente);
        $nueva_disponibilidad = $ingrediente['disponibilidad'] ? 0 : 1;
        if ($ingredientesModel->actualizarIngrediente($id_ingrediente, $ingrediente['nom_ingrediente'], $nueva_disponibilidad)) {
            header("Location: ingredientes.php?mensaje=disponibilidad_actualizada");
        } else {
            header("Location: ingredientes.php?mensaje=error");
        }
        exit();
    }

    // Eliminar ingrediente
    if (isset($_POST['eliminar'])) {
        $id_ingrediente = $_POST['id_ingrediente'];
        if ($ingredientesModel->eliminarIngrediente($id_ingrediente)) {
            header("Location: ingredientes.php?mensaje=eliminado");
        } else {
            header("Location: ingredientes.php?mensaje=error");
        }
        exit();
    }
}