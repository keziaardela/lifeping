<?php
class Reminder {
    private $conn;
    private $table_name = "reminder"; // nama tabel di DB

    public $id;
    public $judul;
    public $deskripsi;
    public $tanggal;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET judul=:judul, deskripsi=:deskripsi, tanggal=:tanggal";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":judul", $this->judul);
        $stmt->bindParam(":deskripsi", $this->deskripsi);
        $stmt->bindParam(":tanggal", $this->tanggal);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY tanggal ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->judul = $row['judul'];
        $this->deskripsi = $row['deskripsi'];
        $this->tanggal = $row['tanggal'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET judul = :judul, deskripsi = :deskripsi, tanggal = :tanggal 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':judul', $this->judul);
        $stmt->bindParam(':deskripsi', $this->deskripsi);
        $stmt->bindParam(':tanggal', $this->tanggal);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
