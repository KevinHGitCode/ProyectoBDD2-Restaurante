<?php
// inicializa la conexion a la base de datos

$servername = "b3f4tfoojx7qlecm12vn-mysql.services.clever-cloud.com";
$username = "uv1e8cvzidly8ssz";
$password = "qkpH0yjlC3ZWn6Q73Twt";
$dbname = "b3f4tfoojx7qlecm12vn";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";

$conn->close();