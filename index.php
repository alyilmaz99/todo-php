<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

require_once 'helper/session_helper.php';
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
    <div style="display: flex; justify-content: center">
        <button id="profile">Profile</button>
    </div>
    <div style="display: flex; justify-content: center">
        <button id="logOut">Log Out</button>
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
var button = document.getElementById("logOut");
button.addEventListener("click", function() {
    window.location.href = "auth/logout.php";

})
var button = document.getElementById("profile");
button.addEventListener("click", function() {
    window.location.href = "profile/profile.view.php";

})
</script>

</html>