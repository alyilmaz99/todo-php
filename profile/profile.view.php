<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

require_once "profile.controller.php";
$profile = new Profile();
$user = $profile->getUser();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css" />

</head>

<body>
    <?php if (isset($_SESSION['user_id'])): ?>
    <div style="display: flex; justify-content: center">
        <h1>Profile</h1>

    </div>
    <div style="display: flex; justify-content: center">
        <form action="profile.controller.php" method="post">
            <label type="email">Email</label>

            <input type="email" name="email" placeholder="<?php echo $user[0]["email"] ?>">
            <label type="
                name">Name</label>
            <input type="name" placeholder="<?php echo $user[0]["name"] ?>" name="name">


            <button id="update">UPDATE</button>
        </form>
    </div>


    <div style="display: flex; justify-content: center">
        <p>
            <a href=" ../index.php">Anasayfa</a>
        </p>
    </div>
    <?php else: ?>
    <div>
        <?php header("Location: ../auth/login.php")?>

    </div>
    <?php endif;?>
</body>
<script>
var button = document.getElementById("update");
button.addEventListener("click", function() {
    window.location.href = "profile.controller.php";

})
</script>

</html>