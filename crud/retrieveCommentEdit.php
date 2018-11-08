<?php
include('connect.php');
function retrieveCommentEdit($superGlobal)
{
    global $db;

    if(isset($superGlobal))
    {
        $post_id = filter_input(INPUT_GET, 'edit', FILTER_SANITIZE_NUMBER_INT);

        if(!$post_id)
        {
            header('Location: ../index.php');
            exit;
        }

        $query = "SELECT * FROM comment WHERE commentsid = {$post_id}";
        $tables = $db->prepare($query);
        $tables -> execute();
        $column = $tables->fetchAll();
    }

    if($tables -> rowCount() != null)
    {
        foreach($column as $columns)
        {
            ?>

            <p>
                <label for="title">Title</label>
                <input name="title" id="title" value= "<?= $columns['title']?>"/>
            </p>
            <p>
                <label for="content">Content</label>
                <textarea name="content" id="content"><?= $columns['content']?></textarea>
            </p>

            <p>
                <input type="hidden" name="id" value="<?= $columns['commentsID']?>" />
                <input type="submit" name="update" value="Update" />
                <input type="submit" name="delete" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
            </p>

            <?php
        }
    }
}
?>