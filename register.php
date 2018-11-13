<?php
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
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="navBar">
    <?php include("nav.php");?>
</div>

<div id="content">
    <form class="well" action="processRegister.php" method="POST">
        <fieldset>
            <legend>Register</legend>
            <div class="form-group">
                
                    <label for="username" >Username</label>
                    <input type="text" class="form-control" for="username" id="username" maxlength="16"/>
                
            </div>

            <div class="form-group">
                
                    <label for="pass">Password</label>
                    <input type= "text" class="form-control" for="pass" id="pass"/>
                
            </div>

            <div class = "form-group">
                
                    <label for="confirm">Confirm Password</label>
                    <input type= "text" class="form-control" for="confirm" id="confirm"/>
                
            </div>
            
            
                <input type="submit" class= "btn btn-primary" name="signup" value="Register" />
            
        </fieldset>
    </form>
</div>
</body>
</html>