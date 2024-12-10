<?php
// Include database connection
include '../../db.php';

// Initialize search variable
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query to fetch data from the database with search functionality
$query = "SELECT id, no, nama, kategori, kondisi, penanggung_jawab, jumlah FROM aset_prodi";
if (!empty($search)) {
    $query .= " WHERE nama LIKE :search"; // Use LIKE for partial matches
}

$query .= " ORDER BY id ASC";

// Prepare and execute the query
$stmt = $pdo->prepare($query);

if (!empty($search)) {
    $stmt->bindValue(':search', '%' . $search . '%'); // Bind the search term
}

$stmt->execute();

// Check if there are any results
if ($stmt->rowCount() > 0) {
    // Display results in the table
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
            <td>" . htmlspecialchars($row['no']) . "</td>
            <td>" . htmlspecialchars($row['nama']) . "</td>
            <td>" . htmlspecialchars($row['kategori']) . "</td>
            <td>" . htmlspecialchars($row['kondisi']) . "</td>
            <td>" . htmlspecialchars($row['penanggung_jawab']) . "</td>
            <td>" . htmlspecialchars($row['jumlah']) . "</td>
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
    echo "<tr><td colspan='7'>Belum ada data yang ditambahkan</td></tr>";
}
?>