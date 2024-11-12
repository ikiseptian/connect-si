<?php
include '../../db.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Menyurat</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>

<body>

    <!-- Header -->
    <nav class="navbar">
        <div class="logo">
            <img src="../../image/logo.png" alt="Logo" style="height: 50px;">
            <img src="../../image/login2.png" alt="Logo" style="height: 50px; margin-left: 10px;">
        </div>
        <div class="nav-links" style="margin-right: 710px;">
            <a href="../dashboard/dashboard.html">Beranda</a>
            <a href="#">Tanggal Penting</a>
            <a href="../pengunguman/pengunguman.html">Pengumuman</a>
            <a href="../surat_surat/surat_surat.html">Surat Menyurat</a>
            <div style="position: relative; display: inline-block;">
                <a href="#" style="text-decoration: none;">Arsip Surat</a>
                <div style="display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                    <a href="../aset_masuk/aset_masuk" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Aset Masuk</a>
                    <a href="../aset_keluar/aset_keluar.html" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Aset Keluar</a>
                </div>
            </div>
            <a href="../aset_prodi/aset_prodi.html">Aset Prodi</a>
        </div>
        <div>
            <a href="profil.html">
                <img src="../../image/login2.png" style="height: 30px;" alt="">
            </a>
        </div>
    </nav>
    <div>
        <a href="../dashboard/dashboard.html">
            <img src="../../image/back1.png" style="height: 40px; margin-left: 20px; margin-top: 10px;" alt="">
        </a>
    </div>

    <!-- Main container -->
    <div class="container" style="margin-top: 20px;">
        <div class="title-bar">
            <span>Aset Prodi</span>
            <div class="actions">
                <form action="tambah.php" method="get">
                    <img src="../../image/tambah.png" style="height: 30px;" alt="">
                </form>

                <button title="Print">
                    <img src="../../image/print.png" style="height: 30px; padding-right: 10px;" alt="">
                </button>
                <input type="text" class="search-bar" placeholder="Search...">
            </div>
        </div>

        <!-- Table -->
        <table>
            <thead>
                <tr>
                    <th>No Aset</th>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                    <th>Kondisi</th>
                    <th>Penanggung jawab</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Query untuk mengambil data dari database
                $query = "SELECT no, nama, kategori, kondisi, penanggung_jawab, jumlah FROM aset_prodi ORDER BY no ASC";
                $result = $pdo->query($query); // Langsung mengeksekusi query tanpa prepare

                // Memeriksa apakah ada data yang ditemukan
                if ($result && $result->rowCount() > 0) {
                    // Menampilkan hasil query dalam tabel
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>
                                    <td>" . htmlspecialchars($row['no']) . "</td>
                                    <td>" . htmlspecialchars($row['nama']) . "</td>
                                    <td>" . htmlspecialchars($row['kategori']) . "</td>
                                    <td>" . htmlspecialchars($row['kondisi']) . "</td>
                                    <td>" . htmlspecialchars($row['penanggung_jawab']) . "</td>
                                    <td>" . htmlspecialchars($row['jumlah']) . "</td>
                                    <td>
                                        <a href=''>
                                            <img src='../../image/delete.png' style='height: 30px;' alt=''>
                                        </a>
                                        <a href=''>
                                            <img src='../../image/edit.png' style='height: 30px; padding-left: 15px;' alt=''>
                                        </a>
                                    </td>
                                </tr>";
                    }
                } else {
                    // Jika tidak ada data ditemukan
                    echo "<tr><td colspan='7'>Belum ada data yang ditambahkan</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="../../js/drop.js"></script>
</body>

</html>