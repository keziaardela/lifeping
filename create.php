<?php
include 'database.php';
include 'reminder.php';

$database = new Database();
$db = $database->getConnection();

$reminder = new Reminder($db);

if ($_POST) {
    $reminder->judul = $_POST['judul'];
    $reminder->deskripsi = $_POST['deskripsi'];
    $reminder->tanggal = $_POST['tanggal'];

    if ($reminder->create()) {
        echo "<script>alert('Reminder berhasil ditambahkan!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambah reminder!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Reminder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Tambah Reminder</h1>
    <form method="POST">
        <p>Judul:<br>
        <input type="text" name="judul" required></p>

        <p>Deskripsi:<br>
        <textarea name="deskripsi" required></textarea></p>

        <p>Tanggal:<br>
        <input type="date" name="tanggal" required></p>

        <button type="submit">Simpan</button>
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>
