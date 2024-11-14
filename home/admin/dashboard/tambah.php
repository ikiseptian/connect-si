<?php
include '../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $no = $_POST['no']; // Ensure this matches the field name in the form
    $judul = $_POST['judul'];
    $tanggal = $_POST['tanggal'];
    
    try {
        // Prepare the query
        $query = "INSERT INTO tanggal_penting (no, judul, tanggal) 
                  VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($query);
        
        // Execute the query with the provided data
        $stmt->execute([$no, $judul, $tanggal]);

        // Redirect to the aset_prodi.php page
        header("Location: dashboard.php");
        exit(); // Ensure no further code is executed after the redirect
    } catch (PDOException $e) {
        // Handle any errors (e.g., database issues)
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Aset Prodi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            margin: -20px -20px 20px -20px;
            border-radius: 5px 5px 0 0;
            display: flex;
            align-items: center;
        }

        .back-button {
            text-decoration: none;
            color: white;
            font-size: 24px;
            margin-right: 20px;
            padding: 5px;
        }

        h2 {
            margin: 0;
            color: white;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }

        input[type="date"]:focus,
        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .submit-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            align-self: flex-end;
            margin-top: 10px;
        }

        .submit-button:hover {
            background-color: #45a049;
        }

        /* Custom styles for SweetAlert2 buttons */
        .swal2-confirm {
            background-color: #4CAF50 !important;
            color: white !important;
            padding: 10px 20px; /* Added padding */
            margin: 0 10px; /* Added margin */
        }

        .swal2-cancel {
            background-color: #f44336 !important;
            color: white !important;
            padding: 10px 20px; /* Added padding */
            margin:  0 10px; /* Added margin */
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <!-- Navbar code remains the same -->
    </nav>

    <div class="container">
        <div class="header">
            <a href="aset_prodi.php" class="back-button">←</a>
            <h2>Tambah Aset Prodi</h2>
        </div>

        <form id="addAssetForm" method="POST" action="">
            <div class="form-group">
                <label for="no">No</label>
                <input type="text" id="no" name="no" required>
            </div>

            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" id="judul" name="judul" required>
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal" required>
            </div>

            <button type="button" class="submit-button" onclick="confirmAdd()">Tambah</button>
        </form>
    </div>

    <script>
        function confirmAdd() {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "swal2-confirm",
                    cancelButton: "swal2-cancel"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You are about to add a new asset!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, add it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('addAssetForm').submit();
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