<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>R6Wiki</title>
    <link href="../stylesheets/style.css?" rel="stylesheet" type="text/css"/>
    <link href="../stylesheets/nav.css?" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>

    <div id="content">
        <form class = "well" action="<?=url('/crud/processComment.php')?>" method="post">
            <fieldset>

                <legend>Comments or Questions</legend>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input class="form-control" name="title" id="title" />
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content"></textarea>
                </div>

                <div class="g-recaptcha" data-sitekey="6LcVmHoUAAAAACryV4B79Ab8Sz9E1AeIL18AoEXF"></div>

                <input type="submit" class ="btn btn-primary" name="create" value="Create" />


                

            </fieldset>
        </form>
    </div>
</body>
</html>