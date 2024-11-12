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
                <th>No Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Kondisi</th>
                <th>Penanggung Jawab</th>
                <th>Jumlah</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT no, nama, kategori, kondisi, penanggung_jawab, jumlah FROM aset_prodi ORDER BY id ASC";
            $stmt = $pdo->query($query);

            if ($stmt->rowCount() > 0) {
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['no']) . "</td>
                            <td>" . htmlspecialchars($row['nama']) . "</td>
                            <td>" . htmlspecialchars($row['kategori']) . "</td>
                            <td>" . htmlspecialchars($row['kondisi']) . "</td>
                            <td>" . htmlspecialchars($row['penanggung_jawab']) . "</td>
                            <td>" . htmlspecialchars($row['jumlah']) . "</td>
                            
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
