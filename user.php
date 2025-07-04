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

    // Fungsi untuk login
    public function login($username, $password) {
        // Query untuk mencari user berdasarkan username
        $query = "SELECT id, username, password FROM " . $this->table_name . " WHERE username = :username LIMIT 1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        // Cek apakah ada data pengguna
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && password_verify($password, $row['password'])) {
            // Jika password cocok, set session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            return true;
        }

        // Jika username atau password salah
        return false;
    }
}
?>
