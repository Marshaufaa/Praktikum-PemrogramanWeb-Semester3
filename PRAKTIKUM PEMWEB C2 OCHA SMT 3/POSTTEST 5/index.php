<?php
session_start(); 
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <script src="script.js"></script>
    <title>Kopi Lih Marsha</title>
</head>
<body>
    <?php 
    if (isset($_SESSION['username'])) { 
        echo '<div style="text-align: right; padding: 10px; background-color: #333; color: #fff;">';
        echo 'Halo, ' . htmlspecialchars($_SESSION['username']) . '! | <a href="dashboard.php" style="color: #fff;">Dashboard</a> | <a href="logout.php" style="color: #fff;">Logout</a>';
        echo '</div>';
    } else {
        echo '<div style="text-align: right; padding: 10px; background-color: #333; color: #fff;">';
        echo '<a href="login.php" style="color: #fff;">Login</a>';
        echo '</div>';
    }
    ?>
    <center>
        <h1>Kopi Lih Marsha</h1>
        <nav>
            <ul>
                <li><a href="#tentang">Tentang Kami</a></li>
                <li><a href="#produk">Produk</a></li>
                <li><a href="#kontak">Kontak</a></li>
            </ul>
        </nav>

        <section id="judul aja">
            <h2>Selamat Datang di Kopi Lih Marsha!</h2>
            <p>Nikmati kopi pilihan terbaik kami, disajikan dengan cinta karena setiap paginya kalibrasi sendiri dan cupping sampai asam lambung. Juga, Kopi Lih Marsha hadir untuk memberikan pengalaman kopi yang nyaman serta tentunya cocok untuk para kaum kaum kalcer #skena</p>
            </section>

        <section id="tentang">
            <h2>Seputar Tentang Kami</h2>
            <p>Kopi Lih Marsha dibentuk pada 15 September 2025 (POSTTEST 1), Makna dari nama Kopi Lih Marsha dikarenakan Pemilik (Marsha) juga seorang Coffee Addicted, Maka tercetus secara tidak sengaja nama 'Kopi Lih Marsha'. </p>
            </section>
<hr>
        <section id="produk">
            <h2>Produk Kami</h2>
            <article>
                <h3>Ice Black</h3>
                <p>Sejenis seperti americano tetapi dengan rasa yang lebih light menggunakan biji kopi arabika dan robusta yang bisa customer pilih sesuai selera.</p>
                <img src="ice black.jpg" alt="poto" />
                </article>
            <article>
                <h3>Butter Coffee</h3>
                <p>Kopi hitam dengan campuran unsalted butter yang memberikan rasa gurih dan tekstur creamy pada setiap tegukan.</p>
                <img src="kopi butter.jpg" alt="poto" />
                </article>
            </section>
        </center>
<hr>
        <section id="kontak">
            <h2>Hubungi Kami</h2>
            <p>Email: info@kopilihmarsha.com</p>
            <p>Telepon: +62 811 5523 789</p>
            <p>Lokasi : Jl. Sambaliung, Universitas Mulawarman, Kota Samarinda, Kalimantan Timur</p>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Kopi Lih Marsha. Hak Cipta Dilindungi Sendiri.</p>
        <p>Referensi Desain: <a href="https://foresthree.co.id/#tentang" target="_blank">Foresthree Coffee dan Kopi Kumana</a></p>
    </footer>
    <script src="script.js"></script> 

</body>
</html>