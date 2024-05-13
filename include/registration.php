<?php

// don't close PHP tag in a pure PHP file
// can cause issues

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $kallenavn = $_POST['kallenavn'];
    $username = $_POST['username'];
    $pwd = (hash("sha512", $_POST['pwd']));
    $confirm_pwd = (hash("sha512", $_POST['confirm_pwd']));
    $email = $_POST['email'];

    try {
        require_once "db.connection.php";

        $query = "SELECT * FROM users WHERE username = :username;";
        $stmt = $pdo -> prepare($query);
        $stmt -> bindParam(':username', $username);
        $stmt -> execute();
        $result = $stmt ->fetch(PDO::FETCH_ASSOC);
        // var_dump($result);
        // print $result;
        // print_r($result);

            
            
        if ($result == false){

            if ($_POST["pwd"] !== $_POST["confirm_pwd"]) {
                header("refresh:0; url=./registration.php");
                echo '<script> alert("password do not match");</script>';
                    die("");
            }
            else {
                

             
            $stmt = $pdo->prepare("INSERT INTO users (kallenavn, username, email, pwd) VALUES (:kallenavn, :username, :email, :pwd)");
            $stmt->bindParam(':kallenavn', $kallenavn);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pwd', $pwd);
            $user_id = $pdo -> lastinsertid(); // User id
            $stmt->execute();

            $pdo = null;
            $stmt = null;        
            header( "refresh:0; url=./loginpg.php" );
            echo '<script> alert("Sign up sucsess");</script>';
            die(""); 
        }

        } else {
            $pdo = null;
            $stmt = null; 
            header("refresh:0; url=./registration.php");
            echo '<script>alert(Username already taken :()</script>';
                die("");
        }

            
            
    } catch(PDOException $e) {
        echo "Noe gikk galt, prøv igjen! Feilmelding: " . $e->getMessage();
    }

    // Disconnect from the database
    $pdo = null;
}

