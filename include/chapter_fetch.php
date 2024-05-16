<?php

require_once 'db.connection.php';

// Checketh
if (isset($_SESSION['username'])) {
    // taketh username
    $username = $_SESSION['username'];

    try {
        // select chapter id from user lgined in
        $query = "SELECT chapter_chapter_id FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $userChapterId = $stmt->fetchColumn();

        // seession
        $_SESSION['user_chapter_id'] = $userChapterId;

        
        // var_dump($userChapterId);
    } catch (PDOException $e) {
        // eroore
        echo "Something went wrong while fetching chapter data: " . $e->getMessage();
    }
} else {
    // not logged in? GET OUT
    header('Location: index.php');
    exit;
}
