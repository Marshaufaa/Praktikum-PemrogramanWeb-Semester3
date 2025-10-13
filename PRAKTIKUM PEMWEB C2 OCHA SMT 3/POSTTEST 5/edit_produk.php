<?php
session_start();
require_once 'koneksi.php';

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$message = '';
$product = null;


if (isset($_GET['id'])) {
    $id_to_edit = $koneksi->real_escape_string($_GET['id']);
    $sql_fetch = "SELECT id, nama_produk, deskripsi, harga, gambar_url FROM produk WHERE id = '$id_to_edit'";
    $result_fetch = $koneksi->query($sql_fetch);

    if ($result_fetch->num_rows == 1) {
        $product = $result_fetch->fetch_assoc();
    } else {
        $message = '<p style="color: red;">Produk tidak ditemukan!</p>';
        $koneksi->close();
    }
} 

// --- UPDATE ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $product) {
    $id = $koneksi->real_escape_string($_POST['id'] ?? '');
    $nama = $koneksi->real_escape_string($_POST['nama_produk'] ?? '');
    $deskripsi = $koneksi->real_escape_string($_POST['deskripsi'] ?? '');
    $harga = $koneksi->real_escape_string($_POST['harga'] ?? 0);
    $gambar = $koneksi->real_escape_string($_POST['gambar_url'] ?? '');

    if (!empty($nama) && is_numeric($harga) && $harga > 0) {
        $sql_update = "UPDATE produk SET 
                       nama_produk = '$nama', 
                       deskripsi = '$deskripsi', 
                       harga = '$harga', 
                       gambar_url = '$gambar'
                       WHERE id = '$id'";
        
        if ($koneksi->query($sql_update) === TRUE) {
            $message = '<p style="color: green;">Produk berhasil diperbarui!</p>';
            $product['nama_produk'] = $nama;
            $product['deskripsi'] = $deskripsi;
            $product['harga'] = $harga;
            $product['gambar_url'] = $gambar;
        } else {
            $message = '<p style="color: red;">Gagal memperbarui produk: ' . $koneksi->error . '</p>';
        }
    } else {
        $message = '<p style="color: red;">Semua field wajib diisi dengan format yang benar!</p>';
    }
}

if (!$product && !isset($_GET['id'])) {
    $message = '<p style="color: red;">ID produk tidak ditemukan di URL.</p>';
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Kopi Lih Marsha</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        .form-container { width: 500px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); background: #fff; }
        .form-container input[type="text"], 
        .form-container textarea, 
        .form-container input[type="number"] { width: 100%; padding: 10px; margin: 8px 0; display: inline-block; border: 1px solid #ccc; box-sizing: border-box; border-radius: 4px; }
        .form-container button { background-color: #2196F3; color: white; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer; width: 100%; border-radius: 4px; }
        .back-link { display: block; text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Produk: <?php echo $product ? htmlspecialchars($product['nama_produk']) : 'Tidak Ditemukan'; ?></h2>
        <?php echo $message; ?>
        
        <?php if ($product): ?>
        <form method="POST" action="edit_produk.php?id=<?php echo $product['id']; ?>">
            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <label for="nama_produk"><b>Nama Produk</b></label>
            <input type="text" name="nama_produk" value="<?php echo htmlspecialchars($product['nama_produk']); ?>" required>

            <label for="deskripsi"><b>Deskripsi</b></label>
            <textarea name="deskripsi" rows="4" required><?php echo htmlspecialchars($product['deskripsi']); ?></textarea>

            <label for="harga"><b>Harga (Rp)</b></label>
            <input type="number" name="harga" step="1000" min="0" value="<?php echo htmlspecialchars($product['harga']); ?>" required>
            
            <label for="gambar_url"><b>URL/Nama File Gambar</b></label>
            <input type="text" name="gambar_url" value="<?php echo htmlspecialchars($product['gambar_url']); ?>" placeholder="Contoh: ice black.jpg">
                
            <button type="submit">Simpan Perubahan</button>
        </form>
        <?php endif; ?>
        
        <a href="dashboard.php" class="back-link">Kembali ke Dashboard</a>
    </div>
</body>
</html>
<?php $koneksi->close(); ?>