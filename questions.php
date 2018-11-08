<?php
 include("crud/auth.php");
 include("global.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>R6Wiki</title>
    <link href="stylesheets/style.css" rel="stylesheet" type="text/css"/>
    <link href="stylesheets/nav.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
</head>
<body>
    <div id="navBar">
        <?php include("nav.php");?>
    </div>

    <div id="content">
        <?php include("crud/postComment.php")?>
    </div>

    <div id="comments">
        <?php include("crud/retrieveComments.php");?>
        <?php retrieveComments();?>
    </div>
</body>
</html>