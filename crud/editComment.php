<?php
include("../global.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>R6Wiki</title>
    <link href="../stylesheets/style.css" rel="stylesheet" type="text/css" />
    <link href="../stylesheets/nav.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

    <?php include("../testnav.php");?>

    <main role="main" class="container">
        <div class="starter-template bg-light">
            <div class="col-md-6 align-middle">
                <form class="well" action="<?=url('/crud/processComment.php')?>" method="post">
                    <legend>Edit Comment / Question</legend>
                    <?php  if(isset($_GET['edit'])){
                        include 'retrieveCommentEdit.php';
                    }?>

                    <?php retrieveCommentEdit($_GET['edit']);?>
                </form>
            </div>
        </div>
    </main>
</body>

</html>
