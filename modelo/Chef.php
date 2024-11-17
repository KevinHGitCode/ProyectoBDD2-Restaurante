<?php
require '../../config/db.php';

class Chef {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Obtener pedidos pendientes
    public function obtenerPedidos($estado = 'En Cola') {
        $stmt = $this->conn->prepare("
            SELECT o.id_pedido, o.id_cliente, o.estado, d.id_producto, p.nom_producto
            FROM Pedidos o
            JOIN Personalizaciones_pedidos d ON o.id_pedido = d.id_pedido
            JOIN Productos p ON d.id_producto = p.id_producto
            WHERE o.estado = ?;
        ");
        $stmt->bind_param("s", $estado);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $pedidos = [];
            while ($row = $result->fetch_assoc()) {
                $pedidos[] = $row;
            }
            $stmt->close();
            return $pedidos;
        }

        $stmt->close();
        return false; // No se encontraron pedidos
    }

    // Cambiar el estado de una orden
    public function cambiarEstadoOrdenes($id_orden, $nuevoEstado) {
        $stmt = $this->conn->prepare("UPDATE Pedidos SET estado = ? WHERE id_pedido = ?");
        $stmt->bind_param("si", $nuevoEstado, $id_orden);

        if ($stmt->execute()) {
            return $stmt->affected_rows > 0; // Verificar si se actualizó el estado
        }

        $stmt->close();
        return false; // No se pudo cambiar el estado
    }

    // Cambiar el estado de los ingredientes
    public function cambiarEstadoIngredientes($id_producto, $nuevoEstado) {
        $stmt = $this->conn->prepare("UPDATE Ingredientes SET disponibilidad = ? WHERE id_ingrediente = ?");
        $stmt->bind_param("si", $nuevoEstado, $id_producto);

        if ($stmt->execute()) {
            return $stmt->affected_rows > 0; // Verificar si se actualizó el estado
        }

        $stmt->close();
        return false; // No se pudo cambiar el estado
    }
}
