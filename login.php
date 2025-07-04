<?php
session_start();
include 'database.php';  // Pastikan koneksi database
include 'user.php';      // Pastikan class User tersedia

// Cek jika user sudah login, arahkan ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

// Proses login jika form di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Membuat objek User dan memanggil fungsi login
    $user = new user($db);
    if ($user->login($username, $password)) {
        // Jika login berhasil, arahkan ke dashboard
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika login gagal, tampilkan pesan error
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — LifePing</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">LifePing</div>
    </header>

    <main class="login-container">
        <div class="login-box">
            <h2>Log in</h2>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <form method="POST" action="login.php">
                <div class="input-group">
                    <label for="username"><i class="fas fa-user"></i> Username</label>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <button type="submit" class="btn">Log in</button>
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </form>
        </div>
    </main>
</body>
</html>
