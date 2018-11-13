<?php
if(isset($_POST['signup'])){
    include 'crud/connect.php';

    $hash_password = password_hash($password);

    
    if($_POST['username'] != null && isset($_POST['username'])){
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    }

    
    if($_POST['pass'] != null && isset($_POST['pass'])){
        $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if($_POST['confirm'] != null && isset($_POST['confirm'])){
        $confirmPass = filter_input(INPUT_POST, 'confirm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if($password && $confirmPass){
        $hashPassword = password_hash($password);
    }
    
    if($username && $hashPassword){
        $query = "INSERT INTO user (username, hashed) 
            values (:username, :hashed)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':hashed', $hashed);

        $stmt->execute();
    } else {
        header("Location: errorpage.php");
    }

    header("Location: login.php");
    exit;
}