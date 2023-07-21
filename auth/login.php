<?php
$is_valid = false;
ini_set('display_errors', true);
error_reporting(E_ALL);
require_once '../helper/database.php';
require_once '../global.php';
DB::Init();

$counter_number = 0;
$total = 0;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $sql = sprintf("SELECT * FROM user 
            WHERE email = '%s'", DB::get()->real_escape_string( $_POST["email"]));
    $result = DB::get()->query($sql);
    $user = $result->fetch_assoc();
    
    if ($user) {
        if (password_verify($_POST["password"], $user["password_hash"])) {
            session_start();
            session_regenerate_id();
            $_SESSION["user_id"] = $user["id"];
           
        }
    }
    $is_valid = true;
 

   
    header("Location: ../index.php");
            exit;
}

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
    <h1>Login</h1>
    <?php if($is_valid) : ?>
    <b>Invalid Login</b>
    <?php endif;?>


    <form method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "")?>">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button>Log in</button>
    </form>
    <div>
        <p>
            <a href="#">Sign Up</a>
        </p>
    </div>
</body>

</html>