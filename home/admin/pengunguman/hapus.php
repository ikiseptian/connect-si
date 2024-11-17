<?php
include '../../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the delete query
    $query = "DELETE FROM pengunguman WHERE id = ?";
    $stmt = $pdo->prepare($query);
    
    if ($stmt->execute([$id])) {
        // Redirect back to the main page after deletion
        header("Location: create.php");
        exit();
    } else {
        echo "Error deleting record.";
    }
} else {
    echo "No ID provided.";
}
?>