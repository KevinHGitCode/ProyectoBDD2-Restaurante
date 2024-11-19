<?php
// Permite abrir la conexion a la base de datos
class Database {
    private $servername = "b3f4tfoojx7qlecm12vn-mysql.services.clever-cloud.com";
    private $username = "uv1e8cvzidly8ssz";
    private $password = "qkpH0yjlC3ZWn6Q73Twt";
    private $dbname = "b3f4tfoojx7qlecm12vn";
    public $conn;

    public function connect() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
        return $this->conn;
    }
}