<?php
include 'connect.php';

function retrieveFullComment($superGlobal)
{
    global $db;

    if(isset($superGlobal))
    {
        $post_id = filter_input(INPUT_GET, 'fullpage', FILTER_SANITIZE_NUMBER_INT);

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
<main role="main" class="container">
    <div class="starter-template bg-light">
        <h1><a href="fullComment.php"></a>
            <?= $columns['title'] ?>
        </h1>
        <p>
            <small>
                <?= $columns['datetime'] ?>
                <a href="editComment.php?edit=<?= $columns['commentsID'] ?>">edit</a>
            </small>
        </p>

        <div class="md-5">
            <p class="lead">
                <?= $columns['content'] ?><br></p>
            <?php if($columns['imagename'] != null && $columns['imagename'] != "none") {?>
            <img src="../pImage/<?=$columns['imagename'] ?>" alt="photo" />
            <?php } ?>
        </div>
    </div>

</main>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script>
    window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')

</script>
<script src="../../assets/js/vendor/popper.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
<?php
        }
    }
    else
    {
        print "No comments available";
    }
}

?>
