<?php
include '../../db.php'; // Pastikan jalur ini benar

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $active = $_POST['active'];

    // Update the active status in the database
    $query = "UPDATE pengunguman SET active = :active WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':active', $active, PDO::PARAM_INT);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
}
?>