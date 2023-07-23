<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <div style="display: flex; justify-content: center">
        <?php if (isset($_SESSION["user_id"])): ?>

        <h1>Welcome <?php echo $_SESSION["user_name"]; ?> </h1>
        <?php else: ?>
        <p> <?php echo "USER BİLGİSİNDE HATA VAR!"; ?> </p>
        <?php endif;?>
    </div>

    <div style="display: flex; justify-content: center">
        <a href="team/view.team.php">Teams</a>
    </div>
    <div style="display: flex; justify-content: center">
        <a href="todo/todo.view.php">Todo</a>
    </div>

</body>

</html>