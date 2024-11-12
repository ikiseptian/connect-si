<?php
include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $no_aset = $_POST['no']; // Ensure this matches the field name in the form
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $kondisi = $_POST['kondisi'];
    $penanggung_jawab = $_POST['penanggung_jawab'];
    $jumlah = $_POST['jumlah'];

    try {
        // Prepare the query
        $query = "INSERT INTO aset_prodi (no, nama, kategori, kondisi, penanggung_jawab, jumlah) 
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);
        
        // Execute the query with the provided data
        $stmt->execute([$no_aset, $nama, $kategori, $kondisi, $penanggung_jawab, $jumlah]);

        // Redirect to the aset_prodi.php page
        header("Location: aset_prodi.php");
        exit(); // Ensure no further code is executed after the redirect
    } catch (PDOException $e) {
        // Handle any errors (e.g., database issues)
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aset Prodi</title>
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
        input[type="number"] {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f9f9;
        }

        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            align-self: flex-end;
            margin-top: 10px;
        }

        .submit-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <!-- Navbar code remains the same -->
    </nav>

    <div class="container">
        <div class="header">
            <a href="aset_prodi.php" class="back-button">←</a>
            <h2>Tambah Aset Prodi</h2>
        </div>

        <form method="POST" action="">
            <div class="form-group">
                <label for="no">No Aset</label>
                <input type="text" id="no" name="no" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Aset</label>
                <input type="text" id="nama" name="nama" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" id="kategori" name="kategori" required>
            </div>

            <div class="form-group">
                <label for="kondisi">Kondisi</label>
                <input type="text" id="kondisi" name="kondisi" required>
            </div>

            <div class="form-group">
                <label for="penanggung_jawab">Penanggung Jawab</label>
                <input type="text" id="penanggung_jawab" name="penanggung_jawab" required>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" required>
            </div>

            <button type="submit" class="submit-button">Tambah</button>
        </form>
    </div>
</body>
</html>
