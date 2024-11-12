<?php
$host = 'localhost';
$dbname = 'connect_siiiiii';
$username = 'root'; // Ganti dengan 'root' jika menggunakan user default
$password = ''; // Isi password jika diperlukan

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Koneksi berhasil!";
} catch (PDOException $e) {
    die("Tidak dapat terhubung ke database: " . $e->getMessage());
}
?>
