<?php
include("connect.php");
//This function retrieves all posts from the data base.
//It will only display top 5 posts which are truncated to 50 characters Max.
function retrieveComments()
{
    global $db;
    if(isset($_GET['catid'])){
        
        $catid = $_GET['catid'];
        
        $query = "SELECT category_name FROM category category_id = {$catid}";
        $stmt = $db->prepare($query);
        $stmt->execute();
        $name = $stmt->fetch();
        
        if(isset($_GET['col'])){
            $col = $_GET['col'];
        } else {
            $col = "datetimestamp";
        }
        
        if(isset($_GET['sort'])){
            $sort = $_GET['sort'];
        } else {
            $sort = "ASC";
        }
        
        $sort == 'ASC' ? $sort = 'DESC' : $sort = 'ASC';
        
        $query = "SELECT * FROM comment WHERE com_category_id = {$catid} ORDER BY $col $sort LIMIT 15";
        $tables = $db->prepare($query);
        $tables->execute();
        $column = $tables->fetchAll();
?>
<table class="table table-striped">
    <caption>
        <?= $name['category_name']?>
    </caption>
    <thead class="thead-light">
        <tr>
            <th scope="col"><a href="questionsedit.php?catid=<?= $catid?>&&col=commentsID&&sort=<?=$sort?>">ID</a></th>
            <th scope="col"><a href="questionsedit.php?catid=<?= $catid?>&&col=title&&sort=<?=$sort?>">Title</a></th>
            <th scope="col"><a href="questionsedit.php?catid=<?= $catid?>&&col=content&&sort=<?=$sort?>">Content</a></th>
            <th scope="col"><a href="questionsedit.php?catid=<?= $catid?>&&col=datetimestamp&&sort=<?=$sort?>">Date Posted</a></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <?php
    
    if ($tables->rowCount() != null):
        
        foreach ($column as $columns):
            ?>
    <tr>
        <th scope="row">
            <?= $columns['commentsID']?>
        </th>

        <td>
            <a href=<?=url('/crud/fullComment.php?fullpage='. $columns['commentsID'])?>>
                <?= $columns['title'] ?></a>
        </td>

        <td>
            <?= substr($columns['content'], 0, 100) ?>
            <?php
                if (strlen($columns['content']) > 100) { ?>
            <a href=<?=url('/crud/fullComment.php?fullpage='.$columns['commentsID']) ?>>Read Full Post...</a>
            <?php
                }
                ?>
        </td>
        <td>
            <?= $columns['datetime'] ?>
        </td>

        <td><a href=<?=url('/crud/editComment.php?edit='. $columns['commentsID'])?>>edit</a></td>
        <?php endforeach?>
        <?php endif?>
    </tr>
</table>
<?php
    }
}
