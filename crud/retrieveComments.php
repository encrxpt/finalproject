<?php
include("connect.php");
//This function retrieves all posts from the data base.
//It will only display top 5 posts which are truncated to 50 characters Max.
function retrieveComments()
{
    global $db;

    $query = "SELECT * FROM comment ORDER BY datetimestamp ASC LIMIT 15";
    $tables = $db->prepare($query);
    $tables->execute();
    $column = $tables->fetchAll();


    if ($tables->rowCount() != null) {
        foreach ($column as $columns) {
            ?>
            <div class="blog_post">
            <h2><a href=<?=url('/crud/fullComment.php?fullpage='. $columns['commentsID'])?>><?= $columns['title'] ?></a></h2>
            <p>
                <small>
                    <?= $columns['datetime'] ?>
                    <a href=<?=url('/crud/editComment.php?edit')?>=<?= $columns['commentsID'] ?>">edit</a>
                </small>
            </p>

            <div class='blog_content'>
                <?= substr($columns['content'], 0, 50) ?>
                <?php
                if (strlen($columns['content']) > 50) { ?>
                    <a href=<?=url('/crud/fullComment.php?fullpage')?>=<?= $columns['commentsID'] ?>>Read Full Post...</a>
                    <?php
                }
                ?>
                </div>
                </div>
                <?php
            }
        }
        else
        {
            print "No comments available";
        }
    }
?>