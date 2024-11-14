<?php
// Include database connection
include '../../db.php';

// Initialize search variable
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query to fetch data from the database with search functionality
$query = "SELECT id, no, judul, tanggal FROM tanggal_penting";
if (!empty($search)) {
    $query .= " WHERE judul LIKE :search"; // Use LIKE for partial matches
}

$query .= " ORDER BY id ASC";

// Prepare and execute the query
$stmt = $pdo->prepare($query);

if (!empty($search)) {
    $stmt->bindValue(':search', '%' . $search . '%'); // Bind the search term
}

$stmt->execute();

// Check if there are any results

?>