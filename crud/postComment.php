<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>R6Wiki</title>
    <link href="../stylesheets/style.css?" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div id="container">
        <form class="well" action="<?=url('/crud/processComment.php')?>" method="post" enctype="multipart/form-data">
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
                <label for="image">Upload an Image</label>
                <input type="file" class="form-control-file" id="image" name="fileToUpload" />

                <input type="submit" class="btn btn-primary" name="create" value="Create" />

                <select name="categoryid">

                    <?php $query = "SELECT * FROM category";
                    $tables = $db->prepare($query);
                    $tables -> execute();
                    $column = $tables->fetchAll();
                        foreach($column as $categories):?>

                    <option value="<?= $categories['category_id']?>">
                        <?= $categories['category_name']?>
                    </option>
                    <?php endforeach ?>
                </select>



            </fieldset>
        </form>
    </div>
</body>

</html>
