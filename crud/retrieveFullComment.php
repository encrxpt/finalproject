<?php
include 'connect.php';

function retrieveFullComment($superGlobal)
{
    global $db;

    if(isset($superGlobal))
    {
        $post_id = filter_input(INPUT_GET, 'fullpage', FILTER_SANITIZE_NUMBER_INT);

        if(!$post_id)
        {
            header('Location: errorpage.php');
            exit;
        }

        $query = "SELECT * FROM comment WHERE commentsID = {$post_id}";
        $tables = $db->prepare($query);
        $tables -> execute();
        $column = $tables->fetchAll();
    }

    if($tables -> rowCount() != null)
    {
        foreach($column as $columns)
        {
            ?>

            <div class="blog_post">
                <h2><a href="fullComment.php"></a><?= $columns['title'] ?></h2>
                <p>
                    <small>
                        <?= $columns['datetime'] ?>
                        <a href="editComment.php?edit=<?= $columns['commentsID'] ?>">edit</a>
                    </small>
                </p>

                <div class='blog_content'>
                    <?= $columns['content'] ?>
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