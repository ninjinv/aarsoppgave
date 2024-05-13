<?php

// Ensure this script is accessed via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pwd = hash("sha512", $_POST['pwd']); 

    try {
        
        require_once "db.connection.php";
        
        // Check if username exists
        $query = "SELECT username, pwd FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user !== false) {
            // user exist yippie -> check thy pwd under:
            if ($user['pwd'] === $pwd) {
                // checked thy password n it match
                $_SESSION['username'] = $user['username'];
                echo '<script>alert("W!");</script>';
                
                header("Location: ./mainpage.php");
                exit;
            } else {
                // checked thy password n it dont match
                echo '<script>alert("Incorrect password");</script>';
            }
        } else {
            // user dont exist ur adpoted
            echo '<script>alert("User doesn\'t exist");</script>';
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Something went wrong, please try again! Error message: " . $e->getMessage();
    }
}