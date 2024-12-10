<?php
// include '../../db.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $id = isset($_POST['id']) ? intval($_POST['id']) : null;
//     $status = isset($_POST['status']) ? intval($_POST['status']) : null;

//     if ($id !== null && $status !== null) {
//         $query = "UPDATE pengunguman SET active = :status WHERE id = :id";
//         $stmt = $pdo->prepare($query);
//         $stmt->bindParam(':status', $status, PDO::PARAM_INT);
//         $stmt->bindParam(':id', $id, PDO::PARAM_INT);

//         if ($stmt->execute()) {
//             echo json_encode(['success' => true]);
//         } else {
//             echo json_encode(['success' => false]);
//         }
//     } else {
//         echo json_encode(['success' => false]);
//     }
// }
