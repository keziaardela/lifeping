<?php
session_start();
include 'database.php';
include 'user.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = ''; // Ensure error is initialized to avoid undefined errors

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // Check if the passwords match
    if ($password == $password_confirm) {
        // Initialize the User class and attempt registration
        $user = new User($db);
        if ($user->register($username, $password)) {
            header("Location: login.php"); // Redirect on successful registration
            exit();
        } else {
            // Display error if username is already registered
            $error = "Username sudah terdaftar!";
        }
    } else {
        // Error message if passwords don't match
        $error = "Password tidak cocok!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — LifePing</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="navbar">
        <div class="logo">
            LifePing
            <!-- Tanda panah di samping logo untuk kembali ke Dashboard -->
            <a href="dashboard.php" class="back-arrow">
                <span>&larr;</span>
            </a>
        </div>
    </header>

    <main class="login-container">
        <div class="login-box">
            <h2>Daftar</h2>
            <!-- Display error if exists -->
            <?php if (!empty($error)) { echo "<p class='error'>$error</p>"; } ?>
            <form method="POST" action="register.php">
                <div class="input-group">
                    <label for="username"><i class="fas fa-user"></i> Username</label>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="input-group">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="input-group">
                    <label for="password_confirm"><i class="fas fa-lock"></i> Confirm Password</label>
                    <input type="password" name="password_confirm" placeholder="Confirm Password" required>
                </div>

                <button type="submit" class="btn">Daftar</button>
                <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
            </form>

            <!-- Tambahkan link untuk kembali ke Dashboard -->
            <a href="dashboard.php" class="back-arrow">
                <span>&larr; Kembali ke Dashboard</span>
            </a>
        </div>
    </main>
</body>
</html>
