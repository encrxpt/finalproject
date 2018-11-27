<?php
include("../global.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>R6Wiki</title>
    <link href="../stylesheets/style.css" rel="stylesheet" type="text/css" />
<!--    <link href="../stylesheets/nav.css" rel="stylesheet" type="text/css" />-->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Include external CSS. -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

    <!-- Include Editor style. -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/css/froala_style.min.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <?php include("../testnav.php");?>

    <main role="main" class="container">
        <div class="starter-template bg-light">
            <div class=" align-middle">
<!--                <form class="well" action="<?=url('/crud/processComment.php')?>" method="post" enctype="multipart/form-data">-->
<!--                   <legend>Edit Comment / Question</legend>-->
                    <?php  if(isset($_GET['edit'])){
                        include 'retrieveCommentEdit.php';
                    }?>

                    <?php retrieveCommentEdit($_GET['edit']);?>

                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
                    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

                    <!-- Include Editor JS files. -->

                    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@2.9.1/js/froala_editor.pkgd.min.js"></script>

                    <!-- Initialize the editor. -->
                    <script>
                        $(function() {
                            $('textarea').froalaEditor()
                        });

                    </script>
<!--                    </form>-->
            </div>
        </div>
    </main>
</body>

</html>
