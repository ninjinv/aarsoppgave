<?php


// Ensure this script is accessed via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $pwd = hash("sha512", $_POST['pwd']); 

    try {
        require_once "db.connection.php";
        
        // Check if username exists and fetch role_id as well
        $query = "SELECT username, pwd, role_id FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user !== false) {
            // User exists -> check password
            if ($user['pwd'] === $pwd) {
                // Password matches
                $_SESSION['username'] = $user['username'];
                $_SESSION['role_id'] = $user['role_id'];

                if ($user['role_id'] == 2) {
                    // User is an admin
                    header("refresh:0; url=./changedia.php");
                    echo '<script>alert("Welcome, Admin!");</script>';
                } else {
                    // User is a regular player
                    header("refresh:0; url=./mainpage.php");
                    echo '<script>alert("Welcome!");</script>';
                }
                exit;
            } else {
                // Password does not match
                echo '<script>alert("Incorrect password");</script>';
            }
        } else {
            // User does not exist
            echo '<script>alert("User doesn\'t exist");</script>';
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Something went wrong, please try again! Error message: " . $e->getMessage();
    }
}
?>
