<?php
// Include your database connection file
include 'include/db.connection.php';

// Check if the progress data is sent via POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $rawPostData = file_get_contents('php://input');
    $decodedData = json_decode($rawPostData, true);
    
    if (isset($decodedData['progress'])) {
        // Get the progress data from the POST request
        $progressData = $decodedData['progress'];

        session_start();
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];

            $stmt = $pdo->prepare("UPDATE users SET current_page = :current_page WHERE username = :username");
            $stmt->bindParam(':current_page', $progressData);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // Check if the update was successful
            if ($stmt->rowCount() > 0) {
                // Progress saved successfully
                echo json_encode(array('success' => true));
            } else {
                // Failed to save progress
                echo json_encode(array('success' => false, 'message' => 'Failed to save progress.'));
            }
        } else {
            echo json_encode(array('success' => false, 'message' => 'User not logged in.'));
        }
    } else {
        // Progress data not received
        echo json_encode(array('success' => false, 'message' => 'Progress data not received.'));
    }
}
