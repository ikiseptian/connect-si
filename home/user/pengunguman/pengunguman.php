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
    <title>Halaman Pengumuman</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
</head>

<body>
    <nav class="navbar">
        <div class="logo">
            <img src="../../image/logo.png" alt="Logo" style="height: 50px;">
            <img src="../../image/login2.png" alt="Logo" style="height: 50px; margin-left: 10px;">
        </div>
        <div class="nav-links" style="margin-right: 630px;">
            <a href="../../user/dashboard/dashboard.php">Beranda</a>
            <a href="../../user/tanggal_penting/tanggal_penting.php">Tanggal Penting</a>
            <a href="../../user/pengunguman/pengunguman.php">Pengumuman</a>
            <a href="../../user/surat_surat/surat_surat.php ">Surat Menyurat</a>
            <div style="position: relative; display: inline-block;">
                <a href="#" style="text-decoration: none;">Arsip Surat</a>
                <div style="display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px  0px rgba(0,0,0,0.2); z-index: 1;">
                    <a href="../../user/aset_masuk/aset_masuk.php" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Aset Masuk</a>
                    <a href="../../user/aset_keluar/aset_keluar.php" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Aset Keluar</a>
                </div>
            </div>
            <a href="../../user/aset_prodi/aset_prodi.php">Aset Prodi</a>
        </div>
        <div>
           <a href="../../admin/profil/profil.php">
            <img src="../../image/prof.png"  style="height: 30px;" alt="">
           </a>
        </div>
    </nav>

    <div class="container" style="margin-top: 20px;">
        <div class="title-bar">
            <span>Pengumuman Aktif</span>
            <form action="create.php" method="get">
                <button type="submit" title="Tambah Aset Prodi">
                    <img src="../../image/tambah.png" style="height: 30px;" alt="">
                </button>
            </form>
        </div>

        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $announcements = [];
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $announcements[] = $row; // Simpan pengumuman ke array
                        echo '<div class="swiper-slide">';
                        echo '<img src="get_image.php?id=' . $row['id'] . '" alt="Gambar Pengumuman" style="width: 100%; height: auto;">';
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
        <div class="announcement-description" id="announcement-description">
            <?php
            if (!empty($announcements)) {
                // Tampilkan deskripsi pengumuman pertama sebagai default
                echo '<p>' . htmlspecialchars($announcements[0]['deskripsi']) . '</p>';
            }
            ?>
        </div>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script>
        const swiper = new Swiper('.swiper-container', {
            loop: true,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            on: {
                slideChange: function() {
                    const index = this.realIndex;
                    const descriptions = <?php echo json_encode(array_column($announcements, "deskripsi")); ?>;
                    document.getElementById('announcement-description').innerHTML = '<p>' + descriptions[index] + '</p>';
                },
            },
        });
    </script>
    <script src="../../js/drop.js"></script>
    <script src="../../js/oy.js"></script>
</body>

</html>