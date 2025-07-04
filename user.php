<?php
class User {
    private $conn;
    private $table_name = "users";

    // Properti user
    public $id;
    public $username;
    public $password;
    public $email;

    // Konstruksi untuk menghubungkan ke database
    public function __construct($db) {
        $this->conn = $db;
    }

    // Fungsi login
    public function login($username, $password) {
        $query = "SELECT id, username, password FROM " . $this->table_name . " WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            return true;
        }

        return false;
    }

    // Fungsi register
    public function register($username, $password) {
        // Cek apakah username sudah ada
        $queryCheck = "SELECT id FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        $stmtCheck = $this->conn->prepare($queryCheck);
        $stmtCheck->bindParam(':username', $username);
        $stmtCheck->execute();

        if ($stmtCheck->fetch(PDO::FETCH_ASSOC)) {
            return false; // Username sudah ada
        }

        // Simpan user baru
        $queryInsert = "INSERT INTO " . $this->table_name . " (username, password) VALUES (:username, :password)";
        $stmtInsert = $this->conn->prepare($queryInsert);

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmtInsert->bindParam(':username', $username);
        $stmtInsert->bindParam(':password', $hashedPassword);

        return $stmtInsert->execute();
    }
}
?>
