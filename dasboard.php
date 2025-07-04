<?php
// Menampilkan error untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include file koneksi database dan class Reminder
include 'database.php';
include 'reminder.php';

// Membuat koneksi ke database
$database = new Database();
$db = $database->getConnection();

// Membuat objek reminder
$reminder = new Reminder($db);

// Membaca semua reminder dari database
$stmt = $reminder->readAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - LifePing</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            <img src="img/logo.png" alt="LifePing Logo" />
        </div>
        <nav>
            <a href="dashboard.php">DASHBOARD</a>
            <a href="edit.php">EDIT PROFILE</a>
            <a href="logout.php">LOG OUT</a>
        </nav>
    </header>

    <main class="dashboard">
        <h1>Selamat datang, <?php echo $_SESSION['username']; ?>!</h1>

        <!-- Menampilkan daftar reminder -->
        <section class="task-summary">
            <h2>Reminder Anda</h2>
            <a href="create.php" class="btn orange">Tambah Reminder Baru</a>
            
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
                            <a href="#" onclick="confirmDelete('delete.php?id=<?= $row['id'] ?>')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </section>
    </main>

    <!-- Konfirmasi Hapus -->
    <script>
        function confirmDelete(url) {
            if (confirm('Apakah Anda yakin ingin menghapus reminder ini?')) {
                window.location.href = url;
            }
        }
    </script>
</body>
</html>
