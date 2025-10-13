<?php
session_start();
require_once 'koneksi.php'; 

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

$username = htmlspecialchars($_SESSION['username']);
$message = '';

// --- DELETE ---
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id_to_delete = $koneksi->real_escape_string($_GET['id']);
    $sql_delete = "DELETE FROM produk WHERE id = '$id_to_delete'";
    
    if ($koneksi->query($sql_delete) === TRUE) {
        $message = '<p style="color: green;">Produk berhasil dihapus.</p>';
    } else {
        $message = '<p style="color: red;">Gagal menghapus produk: ' . $koneksi->error . '</p>';
    }
    header('Location: dashboard.php');
    exit;
}

// --- READ ---
$sql_read = "SELECT id, nama_produk, deskripsi, harga, gambar_url FROM produk";
$result = $koneksi->query($sql_read);

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kopi Lih Marsha</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .action-link { margin-right: 5px; text-decoration: none; padding: 5px 10px; border-radius: 3px; }
        .edit { background-color: #2196F3; color: white; }
        .delete { background-color: #f44336; color: white; }
        .add-button { display: inline-block; padding: 10px 15px; background-color: #4CAF50; color: #fff; text-decoration: none; border-radius: 5px; margin-bottom: 15px; }
    </style>
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
                <?php echo $message; ?>

                <h3>Manajemen Produk Kopi</h3>
                <a href="tambah_produk.php" class="add-button">Tambah Produk Baru ➕</a>

                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Produk</th>
                            <th>Deskripsi</th>
                            <th>Harga (Rp)</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama_produk']) . "</td>";
                                echo "<td>" . htmlspecialchars(substr($row['deskripsi'], 0, 50)) . "...</td>"; 
                                echo "<td>" . number_format($row['harga'], 0, ',', '.') . "</td>";
                                echo "<td>" . htmlspecialchars($row['gambar_url']) . "</td>";
                                echo "<td>";
                                echo "<a href='edit_produk.php?id=" . $row['id'] . "' class='action-link edit'>Edit</a>";
                                echo "<a href='?action=delete&id=" . $row['id'] . "' class='action-link delete' onclick='return confirm(\"Yakin ingin menghapus produk ini?\")'>Hapus</a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Belum ada data produk.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <hr>
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
<?php $koneksi->close(); ?>