<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
include 'database.php';
include 'reminder.php';

$database = new Database();
$db = $database->getConnection();

$reminder = new Reminder($db);
$stmt = $reminder->readAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Reminder</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Daftar Reminder</h1>
    <a href="create.php">+ Tambah Reminder</a>
    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>Judul</th>
            <th>Deskripsi</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
            <tr>
                <td><?= htmlspecialchars($row['judul']) ?></td>
                <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                <td><?= htmlspecialchars($row['tanggal']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
                    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin mau dihapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>