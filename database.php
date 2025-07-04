<?php
class Database {
    private $host = "localhost";
    private $db_name = "life_ping"; // nanti kamu bikin database ini
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name,
                                  $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Koneksi error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
