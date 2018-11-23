<?php
include("connect.php");
use \Gumlet\ImageResize;
include '../lib/ImageResize.php';
session_start();



//To Retrieve Current Time.
date_default_timezone_set("America/Winnipeg");
$date = date("M d, Y, h:i A");
$date_time = (string)$date;
$date_time_stamp = date("Y-m-d H:i:s");

function file_is_an_image($temporary_path, $new_path) {
    $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];

    $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
        
    $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
    $actual_mime_type        = getimagesize($temporary_path)['mime'];
        
    $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
    $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        
    return $file_extension_is_valid && $mime_type_is_valid;
}

function file_upload_path($original_filename, $upload_subfolder = '../pImage') {
    $current_Folder = dirname(__FILE__);
    $path_segments = [$current_Folder, $upload_subfolder, basename($original_filename)];
    return join(DIRECTORY_SEPARATOR, $path_segments);
}

$img_check = false;
$has_img = false;

//If create comment is triggered.
if(isset($_POST['create']))
{
    if($_POST['title'] != null && $_POST['content'] != null)
    {
        $title = filter_input(INPUT_POST, 'title',  FILTER_SANITIZE_STRING);
        $content = filter_input(INPUT_POST, 'content',  FILTER_SANITIZE_STRING);
        
         if(!empty($_FILES['fileToUpload']['name'])){
            
        $image_filetype = $_FILES['fileToUpload']['type'];
        //checks if there's an uploaded file. > 0 means empty.
            if($_FILES['fileToUpload']['error'] > 0){
                $img_check = true;
                $has_img = false;
            }
            else{
                $image_filename = $_FILES['fileToUpload']['name'];
                $temporary_image_path = $_FILES['fileToUpload']['tmp_name'];

                $new_image_path = file_upload_path($image_filename);

                //calls function to validate file type
                $file_check = file_is_an_image($temporary_image_path,$new_image_path);
                    
                //filetype check
                if(!$file_check || $image_filetype == "application/pdf"){
                $_SESSION['wrongFile'] = "File type not supported!";
                $img_check = false;
                } else {
                    $img_check = true;
                    $has_img = true;
                }
            }      
        }
        
        if($img_check == true && $has_img == true){
            
            $username = $_SESSION['username'];
            $image_filename = $_FILES['fileToUpload']['name'];
            $temporary_image_path = $_FILES['fileToUpload']['tmp_name'];
            $new_image_path = file_upload_path($image_filename);            
            move_uploaded_file($temporary_image_path, "../pImage/$image_filename");                
            
            //image resizing
            $img = new ImageResize($new_image_path);
            $img->resizeToHeight(200);
            $img->resizeToWidth(200);
            $img->save($new_image_path);
            
            $query = "INSERT INTO comment (title, content, datetime, datetimestamp, imagename, user_upload) 
            values (:title, :content, :datetime, :datetimestamp, :imagename, :user_upload)";
            
            $stmt = $db->prepare($query);
            $stmt->bindValue(':title', $title);
                $stmt->bindValue(':content', $content);
                $stmt->bindValue(':datetime', $date_time);
                $stmt->bindValue(':datetimestamp', $date_time_stamp);
                $stmt->bindValue(':imagename', $image_filename);
                $stmt->bindValue(':user_upload', $username);
            $stmt->execute();
        }  else {
             $query = "INSERT INTO comment (title, content, datetime, datetimestamp, user_upload) 
            values (:title, :content, :datetime, :datetimestamp, :user_upload)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':datetime', $date_time);
        $stmt->bindValue(':datetimestamp', $date_time_stamp);
        $stmt->bindValue(':user_upload', $username);
        $stmt->execute();
        } 
        
    }

    header("Location: ../questions.php");
    exit;
}


if(isset($_POST['delete']))
{
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if ($id)
    {
        $post_id = $_POST['id'];
        $query = "DELETE FROM comment WHERE commentsID = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        header("Location: ../questions.php");
        exit;
    }
}



//If update post is triggered.
if(isset($_POST['update'])) {

    $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!$title || !$content || !$id) {
        $_SESSION['updateError'] = "Please fill in the whole form.";
    }
    
    if(!empty($_FILES['fileToUpload']['name'])){
        
       $image_filetype = $_FILES['fileToUpload']['type'];
        echo 'test1';
        //checks if there's an uploaded file. > 0 means empty.
            if($_FILES['fileToUpload']['error'] > 0){
                $img_check = true;
                $has_img = false;
                echo 'error';
            } else {
                echo 'test2';
                $image_filename = $_FILES['fileToUpload']['name'];
                $temporary_image_path = $_FILES['fileToUpload']['tmp_name'];

                $new_image_path = file_upload_path($image_filename);

                //calls function to validate file type
                $file_check = file_is_an_image($temporary_image_path,$new_image_path);
                    
                //filetype check
                    if(!$file_check || $image_filetype == "application/pdf"){
                    $_SESSION['wrongFile'] = "File type not supported!";
                    $img_check = false;
                    } else{
                        $img_check = true;
                        $has_img = true;
                    }
                } 
        
        if($img_check == true && $has_img == true){
            
            echo 'test3';
            $username = $_SESSION['username'];
            $image_filename = $_FILES['fileToUpload']['name'];
            $temporary_image_path = $_FILES['fileToUpload']['tmp_name'];
            $new_image_path = file_upload_path($image_filename);            
            move_uploaded_file($temporary_image_path, "../pImage/$image_filename");                
            
            //image resizing
            $img = new ImageResize($new_image_path);
            $img->resizeToHeight(200);
            $img->resizeToWidth(200);
            $img->save($new_image_path);
            
            $query = "UPDATE comment SET title = :title, content = :content, imagename = :imagename WHERE commentsID = :id";
            $stmt = $db->prepare($query);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':content', $content);
            $stmt->bindValue(':imagename', $image_filename);
            $stmt->execute();

        // header("Location: ../questions.php");
        exit;
            
        } /*else {
        $query = "UPDATE comment SET title = :title, content = :content WHERE commentsID = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->execute();

        //header("Location: ../questions.php");
        exit;
        }*/
    }  
}

if(isset($_POST['remPhoto'])){
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
    
    $query = "SELECT * FROM comment WHERE commentsID = {id}";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $column = $stmt->fetch();
    
    $file = "pImage/".$column['imagename'];
    unlink($file);
    
    $image_filename = null;
    
    $query = "UPDATE comment SET imagename = :imagename WHERE commentsID = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':imagename', $image_filename);
    $stmt->execute();
    
    header("Location: editComment.php?edit=".$column['commentsID']);
}
 ?>
