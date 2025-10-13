<?php
$host = 'localhost'; 
$user = 'admin';      
$pass = 'rahasia';          
$db_name = 'kopilihmarsha'; 
$koneksi = new mysqli($host, $user, $pass, $db_name);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
echo "Koneksi berhasil"; // Hapus baris ini setelah pengujian
?>