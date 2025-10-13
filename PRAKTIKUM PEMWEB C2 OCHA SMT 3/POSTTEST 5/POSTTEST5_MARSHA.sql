CREATE DATABASE IF NOT EXISTS kopilihmarsha;

USE kopilihmarsha;

-- Tabel untuk menyimpan data produk
CREATE TABLE IF NOT EXISTS produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    deskripsi TEXT,
    harga DECIMAL(10, 2) NOT NULL,
    gambar_url VARCHAR(255) 
);

-- data yang ditambahkan manual
INSERT INTO produk (nama_produk, deskripsi, harga, gambar_url) VALUES
('Ice Black', 'Sejenis seperti americano tetapi dengan rasa yang lebih light menggunakan biji kopi arabika dan robusta yang bisa customer pilih sesuai selera.', 25000.00, 'ice black.jpg'),
('Butter Coffee', 'Kopi hitam dengan campuran unsalted butter yang memberikan rasa gurih dan tekstur creamy pada setiap tegukan.', 28000.00, 'kopi butter.jpg');