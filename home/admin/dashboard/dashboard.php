<?php
include '../../db.php';  // Memasukkan koneksi ke database

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connect SI Unjani</title>
    <link rel="stylesheet" href="../../css/styles.css">

</head>
<ht>
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
        
            <!-- Dropdown for "Arsip Surat" -->
            <div style="position: relative; display: inline-block;">
                <a href="#" style="text-decoration: none;">Arsip Surat</a>
                <div style="display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                    <a href="../aset_masuk/aset_masuk" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Aset Masuk</a>
                    <a href="../aset_keluar/" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Aset Keluar</a>
                </div>
            </div>
            
            <a href="../aset_prodi/aset_prodi.html">Aset Prodi</a>
        </div>
        <div>
           <a href="../profil/profil.html">
            <img src="../../image/login2.png"  style="height: 30px;" alt="">
           </a>
        </div>
    </nav>

    <div class="container" style="margin-top: 20px;">
        <div class="welcome">
            <h1>Selamat Datang</h1>
            <h2>Connect SI Unjani</h2>
            <p>Penghubung antar mahasiswa, dosen dan sekretaris program studi</p>
        </div>

        <div class="event-banner">
            <div class="slider-container">
                <div class="slider">
                    <!-- Slide 1 -->
                    <div class="slide">
                        <div class="event-content">
                            <h3>"Membangun Ketahanan Bangsa Melalui Sains dan Informatika"</h3>
                            
                            <div class="event-details">
                                <div class="event-info">
                                    <p><i class="calendar-icon"></i> Sabtu, 28 Agustus 2021</p>
                                    <p><i class="clock-icon"></i> 13:00 - 16:00 WIB</p>
                                    <p><i class="zoom-icon"></i> Exclusive Zoom</p>
                                </div>
                                
                                <div class="event-participants">
                                    <p>Peserta diutamakan:</p>
                                    <ol>
                                        <li>Siswa SMA/SMK/sederajat se-Indonesia</li>
                                        <li>Guru SMA/SMK/sederajat se-Indonesia</li>
                                        <li>Orangtua Siswa SMA/SMK/sederajat se-Indonesia</li>
                                    </ol>
                                </div>
                            </div>

                            <div class="parallel-session">
                                <h4>PARALLEL SESSION</h4>
                                <div class="sessions">
                                    <div class="session">
                                        <p class="session-title">Menjadi Master Kimia Millennial Bertaraf Internasional di Usia 23 Tahun</p>
                                    </div>
                                    <div class="session">
                                        <p class="session-title">Pengenalan Teknologi Game dan Digital Marketing</p>
                                    </div>
                                </div>
                            </div>

                            <div class="registration">
                                <button class="register-btn">Free Registration</button>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="slide">
                        <div class="event-content">
                            <h3>Event Kedua</h3>
                            <img src="../../image/login2.png" style="height: 200px; justify-content: center;" alt="">
                            <!-- Isi konten slide 2 -->
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="slide">
                        <div class="event-content">
                            <h3>Event Ketiga</h3>
                            <!-- Isi konten slide 3 -->
                        </div>
                    </div>
                </div>
                <button class="slider-btn prev">&#10094;</button>
                <button class="slider-btn next">&#10095;</button>
            </div>
        </div>

        <div class="important-dates">
            <h2>Tanggal Penting</h2>
            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Menangani koneksi dan query dalam satu blok.
                    $query = "SELECT judul, DATE_FORMAT(tanggal, '%d %M %Y') AS tanggal_formatted FROM tanggal_penting ORDER BY tanggal ASC";
                    $result = $pdo->query($query); // Langsung mengeksekusi query tanpa prepare

                    // Memeriksa apakah ada data yang ditemukan
                    if ($result && $result->rowCount() > 0) {
                        // Menampilkan hasil query dalam tabel
                        while ($date = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr><td>" . htmlspecialchars($date['judul']) . "</td><td>" . htmlspecialchars($date['tanggal_formatted']) . "</td></tr>";
                        }
                    } else {
                        // Jika tidak ada data ditemukan
                        echo "<tr><td colspan='2'>Belum ada tanggal penting yang ditambahkan</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="../../js/sliders.js"></script>
    <script src="../../js/drop.js"></script>

</body>
</html>