<?php
include("../global.php");
include("auth.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>R6Wiki</title>
    <link href="../stylesheets/style.css" rel="stylesheet" type="text/css"/>
    <link href="../stylesheets/nav.css" rel="stylesheet" type="text/css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="navBar">
    <?php include("../nav.php");?>
</div>

<div id="content">
  <?php  if(isset($_GET['edit'])){
      include 'retrieveCommentEdit.php';
  }

  ?>
    <form class="well" action="<?=url('/crud/processComment.php')?>" method="post">
        <fieldset>
            <legend>Edit Comment / Question</legend>

            <?php retrieveCommentEdit($_GET['edit']);?>

        </fieldset>
    </form>
</div>
</body>
</html>