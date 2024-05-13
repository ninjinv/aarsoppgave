<?php

session_start();

if(isset($_SESSION['username'])){
    // user logged in tada yada yada
    $username = $_SESSION['username'];
    
    
    // miau
} else {
    // if not login redirect yey
    header('location: index.html');
}