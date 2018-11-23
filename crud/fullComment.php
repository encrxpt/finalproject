<?php
include("../global.php");
include("retrieveFullComment.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>R6Wiki</title>
    <link href="../stylesheets/style.css" rel="stylesheet" type="text/css" />
    <link href="../stylesheets/nav.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

    <?php include("../testnav.php");?>


    <div id="content">
        <div id="all_blogs">
            <?php retrieveFullComment($_GET['fullpage']); ?>
        </div>

    </div>
</body>

</html>
