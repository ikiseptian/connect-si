<?php
include '../../db.php'; // Pastikan jalur ini benar
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

        /* CSS untuk Switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 34px;
            height: 20px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 20px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 14px;
            width: 14px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            border-radius: 50%;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:checked + .slider:before {
            transform: translateX(14px);
        }
    </style>
</head>

<body>

<nav class="navbar">
    <div class="logo">
        <img src="../../image/logo.png" alt="Logo" style="height: 50px;">
        <img src="../../image/login2.png" alt="Logo" style="height: 50px; margin-left: 10px;">
    </div>
    <div class="nav-links" style="margin-right: 710px;">
        <a href="../dashboard/dashboard.php">Beranda</a>
        <a href="#">Tanggal Penting</a>
        <a href="../pengunguman/pengunguman.php">Pengumuman</a>
        <a href="../surat_surat/surat_surat.php">Surat Menyurat</a>
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
       <a href="../profil/profil.html">
        <img src="../../image/prof.png" style="height: 30px;" alt="">
       </a>
    </div>
</nav>

<div>
    <a href="../pengunguman/pengunguman.php">
        <img src="../../image/back1.png" style="height: 40px; margin-left: 20px; margin-top: 10px;" alt="">
    </a>
</div>

<div class="container" style="margin-top: 20px;">
    <div class="title-bar">
        <span>Surat Masuk</span>
        <div class="actions">
            <form action="tambah.php" method="get">
                <button type="submit" title="Tambah Aset Prodi">
                    <img src="../../image/tambah.png" style="height: 30px;" alt="">
                </button>
            </form>
            <button onclick="window.open('print.php', '_blank')">
                <img src="../../image/print.png" style="height: 30px; padding-right: 10px;" alt="">
            </button>

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
                <th>Image</th>
                <th>Tanggal</th>
                <th>Deskripsi</th>
                <!-- <th>Active</th> -->
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Base query for fetching data
            $query = "SELECT id, no, image, tanggal, deskripsi FROM pengunguman";
            
            // Check if search term is provided
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = $_GET['search'];
                $query .= " WHERE tanggal LIKE :search";
            }
            
            $query .= " ORDER BY id ASC";
            $stmt = $pdo->prepare($query);

            // Bind the search term if provided
            if (isset($search)) {
                $stmt->bindValue(':search', "%$search%", PDO::PARAM_STR);
            }

            $stmt->execute();

            // Check if any records found
            if ($stmt->rowCount() > 0) {
                $no = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $checked = $row['active'] ? 'checked' : '';
                    echo "<tr>
                            <td>" . htmlspecialchars($no++) . "</td>
                            <td>
                                <img src='get_image.php?id=" . $row['id'] . "' style='height: 50px;' alt='Image'>
                            </td>
                            <td>" . htmlspecialchars($row['tanggal']) . "</td>
                            <td>" . htmlspecialchars($row['deskripsi']) . "</td>
                            
                            <td>
                                <a href='#' onclick='confirmDelete(" . $row['id'] . ")'>
                                    <img src='../../image/delete.png' style='height: 30px;' alt=''>
                                </a>
                                <a href='edit.php?id=" . $row['id'] . "'>
                                    <img src='../../image/edit.png' style='height: 30px; padding-left: 15px;' alt=''>
                                </a>
                            </td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
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

    function toggleActive(id, checkbox) {
        const isActive = checkbox.checked ? 1 : 0;

        const xhr = new XMLHttpRequest();
        xhr.open("POST", "update_active.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                // Reloading the page to reflect updated announcements
                location.reload();
            }
        };
        xhr.send("id=" + id + "&active=" + isActive);
    }
</script>
<script src="../../js/cek.js"></script>
</body>
</html>