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
<form class="well pl-5" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input name="title" class="form-control" id="title" value="<?= $columns['title']?>" />
    </div>

    <div class="form-group">
        <label for="content">Content</label>
        <textarea name="content" class="form-control" id="content"><?= $columns['content']?></textarea>
    </div>

    <input type="hidden" name="id" value="<?= $columns['commentsID']?>" />
    <?php if(empty($columns['imagename'])) {?>
    <input type="file" class="form-control-file pb-3" name="fileToUpload">
    <?php } else { ?>
    <img src="../pImage/<?=$columns['imagename'] ?>" alt="photo" />
    <input type="submit" class="btn btn-primary" name="remPhoto" value="Remove Image" onclick="return confirm('Are you sure you wish to delete the photo?')" />
    <?php } ?>
    <div class="mt-3">
        <input type="submit" class="btn btn-primary" name="update" value="Update" />
        <input type="submit" class="btn btn-primary" name="delete" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')" />
    </div>

</form>
<?php
        }
    }
}
?>
