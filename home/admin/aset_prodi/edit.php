<?php
include '../../db.php';

// Pastikan ID aset ada di URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Ambil data aset dari database berdasarkan ID
    $query = "SELECT * FROM aset_prodi WHERE id = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id]);
    $asset = $stmt->fetch();

    // Cek apakah aset ditemukan
    if (!$asset) {
        echo "Aset dengan ID $id tidak ditemukan.";
        exit();
    }

    // Proses jika form disubmit untuk memperbarui data aset
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Ambil data dari form dan sanitasi input
        $no_aset = htmlspecialchars($_POST['no']);
        $nama = htmlspecialchars($_POST['nama']);
        $kategori = htmlspecialchars($_POST['kategori']);
        $kondisi = htmlspecialchars($_POST['kondisi']);
        $penanggung_jawab = htmlspecialchars($_POST['penanggung_jawab']);
        $jumlah = (int)$_POST['jumlah'];

        try {
            // Query untuk memperbarui data aset
            $query = "UPDATE aset_prodi SET no = ?, nama = ?, kategori = ?, kondisi = ?, penanggung_jawab = ?, jumlah = ? WHERE id = ?";
            $stmt = $pdo->prepare($query);

            // Eksekusi query dengan data yang diterima
            $stmt->execute([$no_aset, $nama, $kategori, $kondisi, $penanggung_jawab, $jumlah, $id]);

            // Redirect ke halaman aset_prodi.php setelah sukses update
            header("Location: aset_prodi.php");
            exit();
        } catch (PDOException $e) {
            // Menangani error jika terjadi kesalahan pada query
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    // ID tidak ditemukan dalam URL
    echo "ID aset tidak ditemukan.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aset Prodi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px; /* Adjusted width */
            margin: 40px auto; /* Adjusted margin */
            padding: 30px; /* Adjusted padding */
            background-color: #fff;
            border-radius: 8px; /* Border radius */
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin: -30px -30px 20px -30px;
            border-radius: 8px 8px 0 0;
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
            gap: 15px; /* Consistent gap */
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
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            background-color: #f9f9f9;
        }

        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
 align-self: flex-end;
            margin-top: 10px;
            font-size: 16px;
        }

        .submit-button:hover {
            background-color: #45a049;
        }

        /* Custom styles for SweetAlert2 buttons */
        .swal2-confirm {
            background-color: #4CAF50 !important;
            color: white !important;
            padding: 10px 20px;
            margin: 0 10px;
        }

        .swal2-cancel {
            background-color: #f44336 !important;
            color: white !important;
            padding: 10px 20px;
            margin: 0 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="header">
            <a href="aset_prodi.php" class="back-button">←</a>
            <h2>Edit Aset Prodi</h2>
        </div>

        <!-- Form untuk mengedit data aset -->
        <form id="editAssetForm" method="POST" action="">
            <div class="form-group">
                <label for="no">No Aset</label>
                <input type="text" id="no" name="no" value="<?php echo htmlspecialchars($asset['no']); ?>" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Aset</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($asset['nama']); ?>" required>
            </div>

            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" id="kategori" name="kategori" value="<?php echo htmlspecialchars($asset['kategori']); ?>" required>
            </div>

            <div class="form-group">
                <label for="kondisi">Kondisi</label>
                <input type="text" id="kondisi" name="kondisi" value="<?php echo htmlspecialchars($asset['kondisi']); ?>" required>
            </div>

            <div class="form-group">
                <label for="penanggung_jawab">Penanggung Jawab</label>
                <input type="text" id="penanggung_jawab" name="penanggung_jawab" value="<?php echo htmlspecialchars($asset['penanggung_jawab']); ?>" required>
            </div>

            <div class="form-group">
                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" value="<?php echo htmlspecialchars($asset['jumlah']); ?>" required>
            </div>

            <button type="button" class="submit-button" onclick="confirmUpdate()">Update</button>
        </form>
    </div>

    <script>
        function confirmUpdate() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "swal2-confirm",
                    cancelButton: "swal2-cancel"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, update it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('editAssetForm').submit();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your changes are safe :)",
                        icon: "error"
                    });
                }
            });
        }
    </script>
</body>
</html>