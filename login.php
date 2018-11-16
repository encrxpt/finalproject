<?php
include("global.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>R6Wiki</title>
    <link href="stylesheets/nav.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body class="text-center">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <?php include("nav.php");?>
    </nav>

    <form class="form-signin" action="processLogin.php" method="POST">
        <label for="username" class="sr-only">Username</label>
        <input type="text" class="form-control" name="username" id="username" maxlength="16" placeholder="Username" />

        <label for="pass" class="sr-only">Password</label>
        <input type="password" class="form-control" name="pass" id="pass" placeholder="Password" />

        <input type="submit" class="btn btn-lg btn-primary btn-block" name="login-submit" value="Login" />
    </form>
</body>

</html>
