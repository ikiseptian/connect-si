<?php
include '../../db.php'; // Pastikan jalur ini benar

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Siapkan query untuk mengambil gambar berdasarkan ID
    $query = "SELECT image FROM surat_keluar WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Ambil gambar
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        header("Content-Type: image/jpeg"); // Ganti sesuai dengan jenis gambar yang Anda simpan
        echo $row['image']; // Tampilkan gambar
    } else {
        // Jika tidak ditemukan
        header("HTTP/1.0 404 Not Found");
        echo "Image not found.";
    }
} else {
    // Jika ID tidak diberikan
    header("HTTP/1.0 400 Bad Request");
    echo "No ID provided.";
}
?>