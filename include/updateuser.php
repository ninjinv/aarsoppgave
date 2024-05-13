<?php

// dont close php code in pure php file
// can cause issues
// page for updating user

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];
    $email = $_POST["email"];

    try {
        require_once "dbh.inc.php";

        
        $query = "SELECT id FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $id = $row['id'];

        $query = "UPDATE users SET username = :username, pwd = :pwd, email = :email WHERE id = :id;";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":pwd", $pwd);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":id", $id);
        

        $stmt->execute(); // hyur execution go
        $pdo = null;
        $stmt = null;

        header("Location: ../index.php");

        die(); // closing off lol die 
        
    } catch (PDOException $e) {
        die("Query failed"  . $e->getMessage());
    }
}
else {
    header("Location: ../index.php");
}