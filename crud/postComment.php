<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>R6Wiki</title>
    <link href="../stylesheets/style.css?" rel="stylesheet" type="text/css"/>
    <link href="../stylesheets/nav.css?" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
</head>
<body>

    <div id="content">
        <form action="<?=url('/crud/processComment.php')?>" method="post">
            <fieldset>

                <legend>Comments or Questions</legend>
                <p>
                    <label for="title">Title</label>
                    <input name="title" id="title" />
                </p>

                <p>
                    <label for="content">Content</label>
                    <textarea name="content" id="content"></textarea>
                </p>

                <p>
                    <input type="submit" name="create" value="Create" />
                </p>

            </fieldset>
        </form>
    </div>
</body>
</html>