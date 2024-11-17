<?php
session_start();

// Sertakan file koneksi database
include '../db.php';

// Proses login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['nama'];
    $kata_sandi = $_POST['kata_sandi'];

    // Query untuk memeriksa username, password, dan level
    $query = "SELECT * FROM login WHERE username = :username AND password = :password";
    $stmt = $pdo->prepare($query); // Asumsi $pdo adalah objek koneksi dari db.php
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $kata_sandi);
    $stmt->execute();

    // Cek apakah ada hasil yang sesuai
    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Simpan data ke dalam session
        $_SESSION['username'] = $row['username'];
        $_SESSION['level'] = $row['level']; // Ambil level dari tabel

        // Arahkan pengguna berdasarkan level
        if ($row['level'] == 1) {
            header("Location: ../admin/dashboard/dashboard.php"); // Halaman admin
        } elseif ($row['level'] == 2) {
            header("Location: ../user/dashboard/dashboard.php"); // Halaman user
        } elseif ($row['level'] == 3) {
            header("Location: ../mahasiswa/dashboard/dashboard.php"); // Halaman user    
        } else {
            $_SESSION['error'] = "Level pengguna tidak valid.";
            header("Location: login.php"); // Redirect kembali ke login jika level tidak valid
        }
        exit;
    } else {
        // Set error message in session untuk ditampilkan di halaman login
        $_SESSION['error'] = "Nama atau kata sandi salah.";
        header("Location: login.php"); // Redirect kembali ke halaman login
        exit;
    }
}
?>
