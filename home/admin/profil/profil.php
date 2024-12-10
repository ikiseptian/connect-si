<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Mahasiswa</title>
    <link rel="stylesheet" href="../../css/styles.css">
    <script>
        // Function to handle logout action
        function logout() {
            // Clear the user session or authentication token here (for example, clearing localStorage or sessionStorage)
            localStorage.removeItem('userLoggedIn'); // Example for localStorage. You can use sessionStorage or cookies if needed.

            // Redirect the user to the login page or any page after logout
            window.location.href = '../../login/login.php'; // Change the path to the actual login page
        }
    </script>
</head>
<body>
<nav class="navbar">
        <div class="logo">
            <img src="../../image/logo.png" alt="Logo" style="height: 50px;">
            <img src="../../image/login2.png" alt="Logo" style="height: 50px; margin-left: 10px;">
        </div>
        <div class="nav-links" style="margin-right: 630px;">
            <a href="../dashboard/dashboard.php">Beranda</a>
            <a href="../tanggal_penting/tanggal_penting.php">Tanggal Penting</a>
            <a href="../pengunguman/pengunguman.php">Pengumuman</a>
            <a href="../surat_surat/surat_surat.php">Surat Menyurat</a>
        
            <!-- Dropdown for "Arsip Surat" -->
            <div style="position: relative; display: inline-block;">
                <a href="#" style="text-decoration: none;">Arsip Surat</a>
                <div style="display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                    <a href="../aset_masuk/aset_masuk.php" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Aset Masuk</a>
                    <a href="../aset_keluar/aset_keluar.php" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Aset Keluar</a>
                </div>
            </div>
            
            <a href="../aset_prodi/aset_prodi.php">Aset Prodi</a>
        </div>
        <div>
           <a href="../profil/profil.php">
            <img src="../../image/prof.png"  style="height: 30px;" alt="">
           </a>
        </div>
    </nav>
  <div> 
    <a href="../dashboard/dashboard.html">
        <img src="../../image/back1.png" style="height: 40px; margin-left: 20px; margin-top: 10px;" alt="">
    </a>
    <div class="container" style="margin-top: 20px; width: 50%; max-width: 500px; margin-left: auto; margin-right: auto;">
        <div class="profile-card">
            <div class="profile-image"></div>
            <h2 class="profile-name">Hasbi ganteng se jawa barat</h2>
            <p class="profile-status">Mahasiswa</p>
            <p class="profile-nim">NIM 666</p>
            <h3 class="arsip-title">ARSIP SURAT</h3>
            <!-- Logout button with onclick event -->
            <button class="logout-btn" onclick="logout()">KELUAR</button>
        </div>
    </div>
    <script src="../../js/drop.js"></script>

</body>
</html>
