<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — LifePing</title>
    <link rel="stylesheet" href="css/login-style.css">
</head>
<body>

    <header class="navbar">
        <div class="logo">LifePing</div>
        <nav>
            <a href="index.php">HOME</a>
            <a href="#">ABOUT US</a>
            <a href="#">CONTACT</a>
        </nav>
    </header>

    <main class="content">
        <div class="left-image">
            <img src="img/calendar.png" alt="Calendar">
        </div>

        <div class="login-box">
            <h2>Log in</h2>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <form method="POST" action="login.php">
                <div class="input-group">
                    <label>Username</label>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="btn">Log in</button>
                <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
            </form>
        </div>
    </main>

</body>
</html>
