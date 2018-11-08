<?php
include("auth.php");
include("connect.php");
//To Retrieve Current Time.
date_default_timezone_set("America/Winnipeg");
$date = date("M d, Y, h:i A");
$date_time = (string)$date;
$date_time_stamp = date("Y-m-d H:i:s");

//If create comment is triggered.
if(isset($_POST['create']))
{
    if($_POST['title'] != null && isset($_POST['title']))
    {
        $title = filter_input(INPUT_POST, 'title',  FILTER_SANITIZE_STRING);
    }

    if($_POST['content'] != null && isset($_POST['content']))
    {
        $content = filter_input(INPUT_POST, 'content',  FILTER_SANITIZE_STRING);
    }

    if($title && $content)
    {
        $query = "INSERT INTO comment (title, content, datetime, datetimestamp) 
            values (:title, :content, :datetime, :datetimestamp)";
        $update_statement = $db->prepare($query);
        $update_statement->bindValue(':title', $title);
        $update_statement->bindValue(':content', $content);
        $update_statement->bindValue(':datetime', $date_time);
        $update_statement->bindValue(':datetimestamp', $date_time_stamp);

        $update_statement->execute();
    }
    else
    {
        header("Location: errorpage.php");
        exit;
    }

    header("Location: ../index.php");
    exit;
}

if(isset($_POST['delete']))
{
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if ($id)
    {
        $post_id = $_POST['id'];
        $query = "DELETE FROM comment WHERE commentsID = :id";
        $delete_statement = $db->prepare($query);
        $delete_statement->bindValue(':id', $id, PDO::PARAM_INT);
        $delete_statement->execute();

        header("Location: ../index.php");
        exit;
    }
    else
    {
        header("Location: errorpage.php");
        exit;
    }
}



//If update blog post is triggered.
if(isset($_POST['update']))
{

    $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (!$title || !$content || !$id)
    {
        header("Location: errorpage.php");
        exit;
    }
    else
    {
        $query = "UPDATE comment SET title = :title, content = :content WHERE commentsID = :id";
        $update_statement = $db->prepare($query);
        $update_statement->bindValue(':id', $id, PDO::PARAM_INT);
        $update_statement->bindValue(':title', $title);
        $update_statement->bindValue(':content', $content);
        $update_statement->execute();

        header("Location: ../index.php");
        exit;
    }
}
 ?>


