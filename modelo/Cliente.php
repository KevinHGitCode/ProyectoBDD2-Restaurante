<?php
require_once 'config/db.php';

class Cliente {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Obtener productos por categoría
    public function obtenerMenuPorCategoria($categoria) {
        $stmt = $this->conn->prepare("SELECT id_producto, nombre_producto, precio FROM Productos WHERE categoria = ?");
        $stmt->bind_param("s", $categoria);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $productos = [];
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }
            $stmt->close();
            return $productos;
        }

        $stmt->close();
        return false; // No se encontraron productos
    }

    // Realizar un pedido
    public function realizarOrden($id_cliente, $productos) {
        $this->conn->begin_transaction();
        try {
            $stmt = $this->conn->prepare("INSERT INTO Ordenes (id_cliente, estado) VALUES (?, 'En Cola')");
            $stmt->bind_param("i", $id_cliente);
            $stmt->execute();
            $id_orden = $this->conn->insert_id;

            foreach ($productos as $producto) {
                $stmtDetalle = $this->conn->prepare("INSERT INTO DetallesOrden (id_orden, id_producto, cantidad) VALUES (?, ?, ?)");
                $stmtDetalle->bind_param("iii", $id_orden, $producto['id_producto'], $producto['cantidad']);
                $stmtDetalle->execute();
                $stmtDetalle->close();
            }

            $this->conn->commit();
            return $id_orden; // Retorna el ID de la orden creada
        } catch (Exception $e) {
            $this->conn->rollback();
            return false;
        }
    }

    // Consultar estado de la orden
    public function estadoDeLaOrden($id_orden) {
        $stmt = $this->conn->prepare("SELECT estado FROM Ordenes WHERE id_orden = ?");
        $stmt->bind_param("i", $id_orden);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc()['estado'];
            }
        }

        $stmt->close();
        return false; // Orden no encontrada
    }

    // Modificar un pedido si está en cola
    public function modificarOrden($id_orden, $nuevosProductos) {
        $stmt = $this->conn->prepare("SELECT estado FROM Ordenes WHERE id_orden = ?");
        $stmt->bind_param("i", $id_orden);
        $stmt->execute();
        $stmt->bind_result($estado);
        $stmt->fetch();
        $stmt->close();

        if ($estado === 'En Cola') {
            $this->conn->begin_transaction();
            try {
                $stmtDelete = $this->conn->prepare("DELETE FROM DetallesOrden WHERE id_orden = ?");
                $stmtDelete->bind_param("i", $id_orden);
                $stmtDelete->execute();

                foreach ($nuevosProductos as $producto) {
                    $stmtDetalle = $this->conn->prepare("INSERT INTO DetallesOrden (id_orden, id_producto, cantidad) VALUES (?, ?, ?)");
                    $stmtDetalle->bind_param("iii", $id_orden, $producto['id_producto'], $producto['cantidad']);
                    $stmtDetalle->execute();
                    $stmtDetalle->close();
                }

                $this->conn->commit();
                return true;
            } catch (Exception $e) {
                $this->conn->rollback();
                return false;
            }
        }

        return false; // No se puede modificar si no está en cola
    }

    // Cancelar un pedido si está en cola
    public function cancelarOrden($id_orden) {
        $stmt = $this->conn->prepare("UPDATE Ordenes SET estado = 'Cancelado' WHERE id_orden = ? AND estado = 'En Cola'");
        $stmt->bind_param("i", $id_orden);

        if ($stmt->execute()) {
            return $stmt->affected_rows > 0; // Verificar si se actualizó la orden
        }

        $stmt->close();
        return false;
    }

    // Generar factura de lo consumido
    public function generarFactura($id_orden) {
        $stmt = $this->conn->prepare("
            SELECT p.nombre_producto, p.precio, d.cantidad, (p.precio * d.cantidad) AS total 
            FROM DetallesOrden d 
            JOIN Productos p ON d.id_producto = p.id_producto 
            WHERE d.id_orden = ?
        ");
        $stmt->bind_param("i", $id_orden);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $factura = [];
            while ($row = $result->fetch_assoc()) {
                $factura[] = $row;
            }
            $stmt->close();
            return $factura;
        }

        $stmt->close();
        return false; // No se pudo generar factura
    }

    // Método para pagar la factura
    public function pagarFactura($id_orden, $metodoPago) {
        $stmt = $this->conn->prepare("UPDATE Ordenes SET estado = 'Pagado', metodo_pago = ? WHERE id_orden = ? AND estado != 'Cancelado'");
        $stmt->bind_param("si", $metodoPago, $id_orden);

        if ($stmt->execute()) {
            return $stmt->affected_rows > 0;
        }

        $stmt->close();
        return false; // No se pudo procesar el pago
    }
}
?>
