<?php
include '../../db.php'; // Pastikan jalur ini benar

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $no = $_POST['no'];
    $tipe = $_POST['tipe'];
    $tanggal = $_POST['tanggal'];
    $perihal = $_POST['perihal'];
    $id_masuk = $_POST['id_masuk'];

    // Ambil file gambar
    $image = $_FILES['image']['tmp_name'];

    // Validasi input
    if (empty($no) || empty($tipe) || empty($tanggal) || empty($perihal)|| empty($id_masuk) || empty($image)) {
        echo "<script>alert('Semua field harus diisi!');</script>";
    } elseif ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        echo "<script>alert('Error uploading file: " . $_FILES['image']['error'] . "');</script>";
    } else {
        // Baca konten file gambar
        $imageData = file_get_contents($image);

        // Siapkan query untuk menyisipkan data
        $query = "INSERT INTO surat_masuk (no, tipe, tanggal, perihal,image, id_masuk) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);

        // Eksekusi query dengan data yang diberikan
        try {
            $stmt->execute([$no, $tipe, $tanggal,$perihal, $imageData, $id_masuk]);

            // Redirect ke halaman aset_masuk.php
            header("Location: aset_masuk.php");
            exit();
        } catch (PDOException $e) {
            echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Surat Masuk</title>
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
            border:  1px solid #ccc;
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
            <h2>Tambah Surat Masuk</h2>
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="no">Nomor:</label>
                <input type="text" name="no" id="no" required>
            </div>
            <div class="form-group">
                <label for="tipe">Tipe:</label>
                <input type="text" name="tipe" id="tipe" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal:</label>
                <input type="date" name="tanggal" id="tanggal" required>
            </div>
            <div class="form-group">
                <label for="tanggal">Perihal:</label>
                <input type="text" name="perihal" id="perihal" required>
            </div>
            <div class="form-group">
                <label for="image">Gambar:</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <div class="form-group">
                <label for="id_masuk">ID Masuk:</label>
                <input type="number" name="id_masuk" id="id_masuk" required>
            </div>
            <input type="submit" value="Simpan">
        </form>
    </div>
</body>
</html>