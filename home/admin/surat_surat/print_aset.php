<?php
include '../../db.php'; // Hubungkan ke database yang sama
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cetak Surat Surat</title>
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

    <h2>Daftar Surat Surat</h2>

    <table>
        <thead>
            <tr>
                <th>Nim</th>
                <th>Nama Aset</th>
                <th>Tipe</th>
                <th>Tanggal</th>
                <th>Perihal</th>
                <th>Tujuan</th>
                <th>Link</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT nim, nama, tipe, tanggal, perihal, tujuan,link FROM surat_surat ORDER BY id ASC";
            $stmt = $pdo->query($query);

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['nim']) . "</td>
                            <td>" . htmlspecialchars($row['nama']) . "</td>
                            <td>" . htmlspecialchars($row['tipe']) . "</td>
                            <td>" . htmlspecialchars($row['tanggal']) . "</td>
                            <td>" . htmlspecialchars($row['perihal']) . "</td>
                            <td>" . htmlspecialchars($row['tujuan']) . "</td>
                            <td>" . htmlspecialchars($row['link']) . "</td>
                            
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No data found</td></tr>";
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
