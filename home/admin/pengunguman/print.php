<?php
include '../../db.php'; // Hubungkan ke database yang sama
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Aset Prodi</title>
    <style>
        /* Gaya khusus untuk tampilan cetak */
        body {
            font-family: Arial, sans-serif;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        @media print {
            /* Menyembunyikan elemen selain tabel */
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <h2>Daftar Aset Prodi</h2>

    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Tanggal</th>
                <th>Deslripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Ambil data dari database
            $query = "SELECT image,tanggal,deskripsi, id FROM pengunguman ORDER BY id ASC";
            $stmt = $pdo->query($query);

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td><img src='get_image.php?id=" . $row['id'] . "' style='height: 50px;' alt='Image'></td>
                            <td>" . htmlspecialchars($row['tanggal']) . "</td>
                            <td>" . htmlspecialchars($row['deskripsi']) . "</td>
        
                            
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No data found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        // Cetak otomatis saat halaman dibuka
        window.print();
    </script>
</body>
</html>