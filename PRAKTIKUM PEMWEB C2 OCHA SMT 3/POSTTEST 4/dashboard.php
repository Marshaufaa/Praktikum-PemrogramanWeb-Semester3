<?php

session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kopi Lih Marsha</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
        <header>
            <h1>Dashboard Admin</h1>
        </header>

        <main>
            <section>
                <h2>Selamat Datang, <?php echo $username; ?>!</h2>
                <p>Anda telah berhasil masuk ke halaman dashboard admin Kopi Lih Marsha.</p>
                <p>Di sini Anda dapat mengelola konten dan data terkait situs web. (Simulasi)</p>
                
                <a href="index.php" class="button" style="display: inline-block; padding: 10px 15px; background-color: #333; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 10px;">Kembali ke Beranda</a>
                <a href="logout.php" class="button" style="display: inline-block; padding: 10px 15px; background-color: #f44336; color: #fff; text-decoration: none; border-radius: 5px; margin-top: 10px;">Logout</a>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Kopi Lih Marsha. Admin Dashboard.</p>
        </footer>
    </div>
</body>
</html>