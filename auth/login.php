<?php
$is_valid = false;
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css" />
</head>

<body>
    <?php if (isset($_SESSION["user_id"])): ?>
    <?php header("Location: ../index.php");?>
    <?php else: ?>
    <div style="display: flex; justify-content: center">
        <h1>Login</h1>
        <?php if ($is_valid): ?>
        <b>Invalid Login</b>
        <?php endif;?>
    </div>


    <div style="display: flex; justify-content: center">
        <form action="../helper/login_helper.php" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?=htmlspecialchars($_POST["email"] ?? "")?>">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <button>Log in</button>
        </form>
    </div>

    <div style="display: flex; justify-content: center">
        <p>
            <a href="sign-up.php">Sign Up</a>
        </p>
    </div>
    <?php endif;?>
</body>

</html>