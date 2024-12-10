<?php
// include '../../db.php'; // Pastikan jalur ini benar

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $id = isset($_POST['id']) ? intval($_POST['id']) : null;
//     $active = isset($_POST['active']) ? intval($_POST['active']) : null;

//     if ($id !== null && $active !== null) {
//         // Update the active status in the database
//         $query = "UPDATE pengunguman SET active = :active WHERE id = :id";
//         $stmt = $pdo->prepare($query);
//         $stmt->bindValue(':active', $active, PDO::PARAM_INT);
//         $stmt->bindValue(':id', $id, PDO::PARAM_INT);

//         if ($stmt->execute()) {
//             echo json_encode(['success' => true, 'message' => 'Status updated successfully.']);
//         } else {
//             echo json_encode(['success' => false, 'message' => 'Failed to update status.']);
//         }
//     } else {
//         echo json_encode(['success' => false, 'message' => 'Invalid data provided.']);
//     }
// } else {
//     echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
// }
?>
