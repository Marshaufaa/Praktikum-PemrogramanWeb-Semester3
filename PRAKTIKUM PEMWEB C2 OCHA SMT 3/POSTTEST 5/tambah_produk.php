<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$message = '';

// --- CREATE ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $koneksi->real_escape_string($_POST['nama_produk'] ?? '');
    $deskripsi = $koneksi->real_escape_string($_POST['deskripsi'] ?? '');
    $harga = $koneksi->real_escape_string($_POST['harga'] ?? 0);
    $gambar = $koneksi->real_escape_string($_POST['gambar_url'] ?? '');


    if (!empty($nama) && is_numeric($harga) && $harga > 0) {
        $sql_insert = "INSERT INTO produk (nama_produk, deskripsi, harga, gambar_url) 
                       VALUES ('$nama', '$deskripsi', '$harga', '$gambar')";
        
        if ($koneksi->query($sql_insert) === TRUE) {
            $message = '<p style="color: green;">Produk baru berhasil ditambahkan!</p>';
        } else {
            $message = '<p style="color: red;">Gagal menambahkan produk: ' . $koneksi->error . '</p>';
        }
    } else {
        $message = '<p style="color: red;">Semua field wajib diisi dengan format yang benar!</p>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Kopi Lih Marsha</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .form-container { width: 500px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); background: #fff; }
        .form-container input[type="text"], 
        .form-container textarea, 
        .form-container input[type="number"] { width: 100%; padding: 10px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box; border-radius: 4px; }
        .form-container button { background-color: #4CAF50; color: white; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer; width: 100%; border-radius: 4px; }
        .back-link { display: block; text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Tambah Produk Baru</h2>
        <?php echo $message; ?>
        <form method="POST" action="tambah_produk.php">
            <label for="nama_produk"><b>Nama Produk</b></label>
            <input type="text" name="nama_produk" required>

            <label for="deskripsi"><b>Deskripsi</b></label>
            <textarea name="deskripsi" rows="4" required></textarea>

            <label for="harga"><b>Harga (Rp)</b></label>
            <input type="number" name="harga" step="1000" min="0" required>
            
            <label for="gambar_url"><b>URL/Nama File Gambar</b></label>
            <input type="text" name="gambar_url" placeholder="Contoh: ice black.jpg">
                
            <button type="submit">Simpan Produk</button>
            <a href="dashboard.php" class="back-link">Kembali ke Dashboard</a>
        </form>
    </div>
</body>
</html>
<?php $koneksi->close(); ?>