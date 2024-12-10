<?php
include '../../db.php'; // Pastikan jalur ini benar

// Cek apakah ID ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data dari database berdasarkan ID
    $query = "SELECT * FROM pengunguman WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Cek apakah data ditemukan
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "<script>alert('Data tidak ditemukan!'); window.location.href='aset_masuk.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID tidak diberikan!'); window.location.href='aset_masuk.php';</script>";
    exit();
}

// Proses pembaruan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $no = $_POST['no'];
    $tanggal = $_POST['tanggal'];
    $deskripsi = $_POST['deskripsi'];

    // Ambil file gambar
    $image = $_FILES['image']['tmp_name'];

    // Validasi input
    if (empty($no) || empty($tanggal) || empty($deskripsi)) {
        echo "<script>alert('Semua field harus diisi!');</script>";
    } elseif ($_FILES['image']['error'] !== UPLOAD_ERR_OK && !empty($image)) {
        echo "<script>alert('Error uploading file: " . $_FILES['image']['error'] . "');</script>";
    } else {
        try {
            // Jika gambar diupload, baca konten file gambar
            if (!empty($image)) {
                $imageData = file_get_contents($image);
                // Siapkan query untuk memperbarui data dengan gambar
                $query = "UPDATE pengunguman SET no = ?, image = ?, tanggal = ?, deskripsi = ? WHERE id = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$no, $imageData, $tanggal, $deskripsi, $id]);
            } else {
                // Jika gambar tidak diupload, perbarui tanpa mengubah gambar
                $query = "UPDATE pengunguman SET no = ?, tanggal = ?, deskripsi = ? WHERE id = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$no, $tanggal, $deskripsi, $id]);
            }

            // Redirect ke halaman aset_masuk.php dengan pesan sukses
            echo "<script>alert('Data berhasil diperbarui!'); window.location.href='create.php';</script>";
            exit();
        } catch (PDOException $e) {
            echo "<script>alert('Terjadi kesalahan saat memperbarui data: " . $e->getMessage() . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat Masuk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin: -20px -20px 20px -20px;
            border-radius: 5px 5px 0 0;
            display: flex;
            align-items: center;
        }

        .back-button {
            text-decoration: none;
            color: white;
            font-size: 24px;
            margin-right: 20px;
            padding: 5px;
        }

        h2 {
            margin: 0;
            color: white;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
 flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"],
        input[type="file"] {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="aset_masuk.php" class="back-button">←</a>
            <h2>Edit Surat Masuk</h2>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="no">Nomor:</label>
                <input type="text" name="no" id="no" value="<?php echo htmlspecialchars($row['no']); ?>" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar (Gambar Tidak melebihi 1mb):</label>
                <input type="file" name="image" id="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" value="<?php echo htmlspecialchars($row['tanggal']); ?>" required>
            </div><div class="form-group">
                <label for="tanggal">Deskripsi:</label>
                <input type="text" name="deskripsi" id="deskripsi" value="<?php echo htmlspecialchars($row['deskripsi']); ?>" required>
            </div>

            <input type="submit" value="Perbarui">
        </form>
    </div>
</body>
</html>