<?php

if(isset($_POST['login-submit'])){
    
    require 'crud/connect.php';
    session_start();
    
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
    $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);  
    echo $username;

    $query = "SELECT * FROM user WHERE username = '{$username}'";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $rowCount = $stmt->fetchAll();
        
    if($_POST['username'] != null && isset($_POST['username'])){
        if($stmt->rowCount() == 1){
            $_SESSION['username'] = $username;
        }
    } else {
        $_SESSION['invalidUser'] = "Login Unsuccessful. Please Try Again";
    }
       
    if($_POST['pass'] != null && isset($_POST['pass'])){
        if($stmt -> rowCount() != null){
            foreach($rowCount as $userInfo){
                if(password_verify($password, $userInfo['hashed'])){
                    $userRole = $userInfo['user_role'];
                }
            }
        }
    } else {
        $_SESSION['invalidPass'] = "Unsuccessful Login";
    }
       
       if($userRole == 1){
         $_SESSION['admin'] = true;
       } 
    
    header("Location: index.php");

} else {
    header("Location: login.php");
}
