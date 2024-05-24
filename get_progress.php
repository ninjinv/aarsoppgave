<?php
// Include your database connection file
include 'include/db.connection.php';

session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $stmt = $pdo->prepare("SELECT current_page FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode(array('success' => true, 'current_page' => $result['current_page']));
    } else {
        echo json_encode(array('success' => false, 'message' => 'Failed to retrieve progress.'));
    }
} else {
    echo json_encode(array('success' => false, 'message' => 'User not logged in.'));
}
