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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* Custom styles for SweetAlert2 buttons */
        .swal2-confirm {
            background-color: #4CAF50 !important;
            color: white !important;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 4px;
            border: none;
        }

        .swal2-cancel {
            background-color: #f44336 !important;
            color: white !important;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 4px;
            border: none;
        }
    </style>
</head>

<body>

    <!-- Header and Navigation -->
    <nav class="navbar">
        <div class="logo">
            <img src="../../image/logo.png" alt="Logo" style="height: 50px;">
            <img src="../../image/login2.png" alt="Logo" style="height: 50px; margin-left: 10px;">
        </div>
        <div class="nav-links" style="margin-right: 710px;">
            <a href="../dashboard/dashboard.php">Beranda</a>
            <a href="#">Tanggal Penting</a>
            <a href="../pengunguman/pengunguman.html">Pengumuman</a>
            <a href="../surat_surat/surat_surat.php">Surat Menyurat</a>
        
            <!-- Dropdown for "Arsip Surat" -->
            <div style="position: relative; display: inline-block;">
                <a href="#" style="text-decoration: none;">Arsip Surat</a>
                <div style="display: none; position: absolute; background-color: #f9f9f9; min-width: 160px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                    <a href="../aset_masuk/aset_masuk.php" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Aset Masuk</a>
                    <a href="../aset_keluar/aset_keluar.php" style="color: black; padding: 12px 16px; text-decoration: none; display: block;">Aset Keluar</a>
                </div>
            </div>
            
            <a href="../aset_prodi/aset_prodi.html">Aset Prodi</a>
        </div>
        <div>
           <a href="../profil/profil.html">
            <img src="../../image/prof.png"  style="height: 30px;" alt="">
           </a>
        </div>
    </nav>


    <div>
        <a href="../dashboard/dashboard.php">
            <img src="../../image/back1.png" style="height: 40px; margin-left: 20px; margin-top: 10px;" alt="">
        </a>
    </div>

    <!-- Main container -->
    <div class="container" style="margin-top: 20px;">
        <div class="title-bar">
            <span>Aset Prodi</span>
            <div class="actions">

                <!-- Search form -->
                <form method="GET" style="display: inline;">
                    <input type="text" name="search" class="search-bar" placeholder="Search by name..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                    <button type="submit">Search</button>
                </form>
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
                    
                </tr>
            </thead>
            <tbody>
                <?php
                // Base query for fetching data
                $query = "SELECT id, no, nama, kategori, kondisi, penanggung_jawab, jumlah FROM aset_prodi";
                
                // Check if search term is provided
                if (isset($_GET['search']) && !empty($_GET['search'])) {
                    $search = $_GET['search'];
                    $query .= " WHERE nama LIKE :search"; // Add search condition
                }
                
                $query .= " ORDER BY id ASC"; // Add order by clause
                
                $stmt = $pdo->prepare($query);
                
                // Bind the search term if provided
                if (isset($search)) {
                    $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
                }

                $stmt->execute();

                // Check if any records found
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
    </div>

    <script src="../../js/drop.js"></script>
    <script>
        function confirmDelete(id) {
            const searchParam = new URLSearchParams(window.location.search).get("search");
            const deleteUrl = 'hapus.php?id=' + id + (searchParam ? '&search=' + encodeURIComponent(searchParam) : '');

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
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = deleteUrl;
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your action has been cancelled.",
                        icon: "error"
                    });
                }
            });
        }
    </script>
</body>
</html>
