<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <div class="container">
        <div class="login-section">
            <div class="logo">
                <img src="../image/logo.png" alt="Logo" class="logo1">
                <img src="../image/login2.png" alt="Logo SITERPADU" class="logo2" style="margin-left: 10px;">
            </div>
            <h2>Masuk Akun</h2>
            <p>Gunakan akun SITERPADU Anda</p>
            <form action="proses.php" method="post">
                <input type="text" name="nama" placeholder="Masukan Nama" class="input-field" required>
                <input type="password" name="kata_sandi" placeholder="Masukan Kata sandi" class="input-field" required>
                <a href="#" class="forgot-password">Lupa Kata sandi?</a>
                <button type="submit" class="login-button">Masuk</button>
                <?php if (!empty($error)): ?>
                    <p style="color: red;"><?= $error ?></p>
                <?php endif; ?>
            </form>
        </div>
        <div class="image-section">
            <img src="../image/gedung.png" alt="Gedung Kampus">
        </div>
    </div>
</body>
</html>
