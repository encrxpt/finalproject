<?php
include 'crud/connect.php';
session_start();

if(isset($_POST['signup'])){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $userNotInDB = true;
    $query = "SELECT * FROM user  WHERE username = '$username";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $users = $stmt->fetchAll();
    
    if(empty($_POST['username']) && empty($_POST['pass']) && empty($_POST['confirm']) ){
        $_SESSION['emptyUser'] = "Please enter a username";
        $_SESSION['emptyPass'] = "Please enter a password";
        $_SESSION['emptyConfirm'] = "Please confirm your password";
        
    }
    
    if(empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['confirm']) ){
        $_SESSION['emptyUser'] = "Please enter a username";
        $_SESSION['emptyPass'] = "";
        $_SESSION['emptyConfirm'] = "";
        
    }
    
    if(!empty($_POST['username']) && empty($_POST['pass']) && !empty($_POST['confirm']) ){
        $_SESSION['emptyUser'] = "";
        $_SESSION['emptyPass'] = "Please enter a password";
        $_SESSION['emptyConfirm'] = "";
        
    }
    
    if(!empty($_POST['username']) && !empty($_POST['pass']) && empty($_POST['confirm']) ){
        $_SESSION['emptyUser'] = "";
        $_SESSION['emptyPass'] = "";
        $_SESSION['emptyConfirm'] = "Please confirm your password";
        
    }
    
    
    
    if(empty($_POST['username']) && empty($_POST['pass']) && !empty($_POST['confirm']) ){
        $_SESSION['emptyUser'] = "Please enter a username";
        $_SESSION['emptyPass'] = "Please enter a password";
        $_SESSION['emptyConfirm'] = "";
        
    }
    
    if(empty($_POST['username']) && !empty($_POST['pass']) && empty($_POST['confirm']) ){
        $_SESSION['emptyUser'] = "Please enter a username";
        $_SESSION['emptyPass'] = "";
        $_SESSION['emptyConfirm'] = "Please confirm your password";
        
    }
    
    if(!empty($_POST['username']) && empty($_POST['pass']) && empty($_POST['confirm']) ){
        $_SESSION['emptyUser'] = "";
        $_SESSION['emptyPass'] = "Please enter a password";
        $_SESSION['emptyConfirm'] = "Please confirm your password";
        
    }
    
    
        
    
    if ($_POST['username'] != null && isset($_POST['username']) && strlen($_POST['username']) < 20){
   
        if(strlen($_POST['username']) > 20){
            $_SESSION['longUser'] = 'Please use a username less than 20 characters.';
        }
        
        
        if ($stmt->rowCount() > 0){
            foreach($users as $user) {
                if($_POST['username'] = $user['username']){
                    $_SESSION['userInDB'] = "Username already exists";
                    $userNotInDB = false;
                }
            }
         }
    }

    
    if($_POST['pass'] != null && isset($_POST['pass'])){
        $password = filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if($_POST['confirm'] != null && isset($_POST['confirm'])){
        $confirmPass = filter_input(INPUT_POST, 'confirm', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if($password && $confirmPass){
        if($password == $confirmPass){
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $_SESSION['passMatch'] = "Passwords do not match";
        }
    }
        


    
    if($username && $hashPassword && $userNotInDB){
        $query = "INSERT INTO user (username, hashed) 
            values (:username, :hashed)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':hashed', $hashPassword);
        
        $stmt->execute();

    } else {
       header("Location: admin.php");
        exit;
    }

    header("Location: admin.php");
    exit;
}

if(isset($_POST['delete_user'])){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    
    if($username){
        $query = "DELETE FROM user WHERE username = '{$username}'";
        $stmt = $db->prepare($query);
        $stmt->execute();
    }
    
    header("Location: admin.php");
    exit;
}
