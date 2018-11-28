<?php
include("global.php");
include("crud/connect.php");

$query = "SELECT * FROM user";
$stmt = $db->prepare($query);
$stmt->execute();
$userInfo = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>R6Wiki</title>
    <link href="stylesheets/style.css?" rel="stylesheet" type="text/css" />
    <!-- <link href="stylesheets/nav.css?" rel="stylesheet" type="text/css" />-->
    <link href="stylesheets/register.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>


<body>




    <main role="main" class="container mt-5 pt-5">
        <?php include("nav.php");?>
        <div class="starter-template mt-5 pt-5">
            <h1>Welcome to the admin page,
                <?=$_SESSION['username']?>.</h1>
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Username</th>
                        <th scope="col">Password</th>
                        <th scope="col">User Role</th>
                    </tr>
                </thead>
                <?php foreach($userInfo as $userInfos):?>
                <tr>
                    <th scope="row">
                        <?=$userInfos['userID']?>
                    </th>
                    <td>
                        <?=$userInfos['username']?>
                    </td>
                    <td>
                        <?=$userInfos['hashed']?>
                    </td>
                    <td>
                        <?=$userInfos['user_role']?>
                    </td>
                </tr>
                <?php endforeach?>
            </table>
            <div class="container">
                <form class="form-signin" action="adminProcess.php" method="post">
                    <h1 class="h3 mb-3 font-weight-normal">Add User</h1>
                    <label for="username" class="sr-only">Username</label>
                    <input type="text" id="username" name="username" class="form-control" placeholder="Username" autofocus>
                    <span class="text-danger">
                        <?= (!empty($_SESSION['userInDB'])) ? $_SESSION['userInDB'] : '' ?>
                        <?= (!empty($_SESSION['emptyUser'])) ? $_SESSION['emptyUser'] : '' ?>
                        <?= (!empty($_SESSION['longUser'])) ? $_SESSION['longUser'] : '' ?>
                    </span>
                    <label for="pass" class="sr-only">Password</label>
                    <input type="password" name="pass" id="pass" class="form-control" placeholder="Password">
                    <span class="text-danger">
                        <?= (!empty($_SESSION['emptyPass'])) ? $_SESSION['emptyPass'] : '' ?>
                    </span>
                    <label for="confirm" class="sr-only">Confirm Password</label>
                    <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Confirm Password">
                    <span class="text-danger">
                        <?= (!empty($_SESSION['passMatch'])) ? $_SESSION['passMatch'] : '' ?>
                        <?= (!empty($_SESSION['emptyConfirm'])) ? $_SESSION['emptyConfirm'] : '' ?>
                    </span>
                    <label for="user_role" class="sr-only">User Role</label>
                    <input type="number" class="form-control" name="user_role" id="user_role" min="0" max="1">

                    <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="signup">Sign up</button>
                </form>
                <div>
                    <form class="form-signin" action="adminProcess.php" method="post">
                        <h1 class="h3 mb-3 font-weight-normal">Delete User</h1>
                        <label for="username" class="sr-only">Username</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Username">

                        <button class="btn btn-lg btn-primary btn-block mt-3" type="submit" name="delete_user">Delete User</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>

<?php
$_SESSION['userInDB'] = "";
$_SESSION['passMatch'] = "";
$_SESSION['emptyUser'] = "";
$_SESSION['emptyPass'] = "";
$_SESSION['emptyConfirm'] = "";
