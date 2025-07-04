<?php
session_start();
include 'database.php';
include 'user.php';

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password == $password_confirm) {
        $user = new User($db);
        if ($user->register($username, $password)) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Username sudah terdaftar!";
        }
    } else {
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
    <link rel="stylesheet" href="css/signup-style.css">
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">LifePing</div>
        <nav>
            <a href="#">Home</a>
            <a href="#">About Us</a>
            <a href="#">Contact</a>
        </nav>
    </header>

    <!-- Main content -->
    <main class="content">
        <div class="left-image">
            <img src="img/calendar.png" alt="Calendar"> <!-- ganti sesuai file -->
        </div>

        <!-- Signup box -->
        <div class="signup-box">
            <h2>Daftar</h2>
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
        </div>
    </main>
</body>
</html>
