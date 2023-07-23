<?php
session_start();
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Anasayfa</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css" />
</head>

<body>
    <?php if (!isset($_SESSION["user_id"])): ?>
    <?php header("Location: auth/login.php");?>
    <?php else: ?>
    <div style="display: flex; justify-content: center">
        <h1>Welcome <?php echo $_SESSION["user_name"]; ?> </h1>
    </div>
    <div style="display: flex; justify-content: center">

        <button id="team">Teams</button>
    </div>
    <div style="display: flex; justify-content: center">
        <button id="todo">Todo</button>
    </div>
    <?php endif;?>
</body>

<script>
var button = document.getElementById("team");
button.addEventListener("click", function() {
    window.location.href = "team/view.team.php";
})
var button = document.getElementById("todo");
button.addEventListener("click", function() {
    window.location.href = "todo/todo.view.php";
})
</script>

</html>