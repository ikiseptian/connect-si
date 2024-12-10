<?php
include '../../db.php'; // Pastikan jalur ini benar

// Query untuk mengambil data pengumuman yang aktif
$query = "SELECT id, image, tanggal, deskripsi FROM pengunguman";
$stmt = $pdo->prepare($query);
$stmt->execute();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Dashboard</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        .swiper-container {
            width: 100%;
            height: 600px; /* Increased height */
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../../image/logo.png" alt="Logo" style="height: 50px;">
            <img src="../../image/login2.png" alt="Logo" style="height: 50px; margin-left: 10px;">
        </div>
        <div class="nav-links" style="margin-right: 999px;">
            <a href="../../mahasiswa/dashboard/dashboard.php">Beranda</a>
            <a href="../../mahasiswa/tanggal_penting/tanggal_penting.php">Tanggal Penting</a>
            <!-- <a href="../pengumuman/pengunguman.php">Pengumuman</a>
            <a href="../surat_surat/surat_surat.php">Surat Menyurat</a>
            <a href="../aset_prodi/aset_prodi.php">Aset Prodi</a> -->
        </div>
        <div>
            <a href="../../admin/profil/profil.php">
                <img src="../../image/prof.png" style="height: 30px;" alt="">
            </a>
    </nav>

    <div class="container" style="margin-top: 20px;">
        <div class="title-bar">
            <span>Pengumuman Aktif</span>
        </div>

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $announcements = [];
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $announcements[] = $row; // Simpan pengumuman ke array
                        echo '<div class="swiper-slide">';
                        echo '<img src="get_image.php?id=' . $row['id'] . '" alt="Gambar Pengumuman" style="width: 100%; height: 100%; ">';
                        echo '</div>';
                    }
                } else {
                    echo "<p>Tidak ada pengumuman aktif saat ini.</p>";
                }
                ?>
            </div>
            <?php if (!empty($announcements)) : ?>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            <?php endif; ?>
        </div>

        <!-- Deskripsi Pengumuman -->
        <div id="announcement-description"></div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>
    <script src="../../js/drop.js"></script>
    <script src="../../js/oy.js"></script>
</body>
</html>

<div class="important-dates">
    <h2>Tanggal Penting</h2>
    <div class="container" style="margin-top: 20px;">
        <div class="title-bar">
            <span></span>
            <div class="actions">
                <form method="GET" style="display: inline;">
                    <input type="text" name="search" class="search-bar" placeholder="Search by name..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
            <?php
            // Menangani koneksi dan query dalam satu blok.
            $search = isset($_GET['search']) ? "%" . $_GET['search'] . "%" : "%";
            $query = "SELECT id, no, judul, DATE_FORMAT(tanggal, '%d %M %Y') AS tanggal_formatted FROM tanggal_penting WHERE judul LIKE ? ORDER BY tanggal ASC";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$search]);

            // Memeriksa apakah ada data yang ditemukan
            if ($stmt && $stmt->rowCount() > 0) {
                // Menampilkan hasil query dalam tabel
                while ($date = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>" . htmlspecialchars($date['no']) . "</td>
                            <td>" . htmlspecialchars($date['judul']) . "</td>
                            <td>" . htmlspecialchars($date['tanggal_formatted']) . "</td>
                          </tr>";
                }
            } else {
                // Jika tidak ada data ditemukan
                echo "<tr><td colspan='3'>Belum ada tanggal penting yang ditambahkan</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>