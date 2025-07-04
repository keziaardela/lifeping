<?php
include 'database.php';
include 'reminder.php';

$database = new Database();
$db = $database->getConnection();

$reminder = new Reminder($db);

$id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan.');
$reminder->id = $id;
$reminder->readOne();

if ($_POST) {
    $reminder->judul = $_POST['judul'];
    $reminder->deskripsi = $_POST['deskripsi'];
    $reminder->tanggal = $_POST['tanggal'];

    if ($reminder->update()) {
        echo "<script>alert('Reminder berhasil diupdate!'); window.location='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate reminder!');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Reminder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Reminder</h1>
    <form method="POST">
        <p>Judul:<br>
        <input type="text" name="judul" value="<?= htmlspecialchars($reminder->judul) ?>" required></p>

        <p>Deskripsi:<br>
        <textarea name="deskripsi" required><?= htmlspecialchars($reminder->deskripsi) ?></textarea></p>

        <p>Tanggal:<br>
        <input type="date" name="tanggal" value="<?= htmlspecialchars($reminder->tanggal) ?>" required></p>

        <button type="submit">Update</button>
    </form>
    <a href="index.php">Kembali</a>
</body>
</html>
