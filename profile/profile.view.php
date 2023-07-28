<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();
require_once "profile.controller.php";

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
    <h1>Profile</h1>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($user as $user): ?>
            <tr>
                <td><?php echo $user["id"] ?></td>
                <td><?php if (!isset($user["team_id"])) {
    echo " Team atanmadi";
} else {
    echo $todos["team"];
}?></td>
                <td><?php echo $user["name"] ?></td>
                <td><?php echo $user["task"] ?></td>
                <td><?php if ($todos['is_complated']) {
    echo "Completed";
} else {
    echo 'Not Completed';
}?></td>
                <td>
                    <form action="todo.controller.php" method="post">
                        <input type="hidden" name="delete_todo1" value="<?php echo $todos["id"] ?>">
                        <button type="submit" name="delete_todo2">Delete</button>
                    </form>
                </td>
                <td>
                    <form action="update.view.php" method="get">
                        <input type="hidden" name="id" value="<?php echo $todos["id"] ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
                <td>
                    <form action="todo.controller.php" method="post">
                        <input type="hidden" name="complete" value="<?php echo $todos["id"] ?>">
                        <button type="submit">Complete</button>
                    </form>
                </td>
            </tr>

            <?php endforeach;?>
        </tbody>
    </table>

    <div>
        <a href=" ../index.php">Anasayfa</a>
    </div>
    <?php else: ?>
    <div>
        <?php header("Location: ../auth/login.php")?>

    </div>
    <?php endif;?>
</body>
<script>
var button = document.querySelectorAll('.update-todo-team')
if (button) {
    button.forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault()
            var team_id = button.getAttribute('data-id')
            var teamIdInput = document.getElementById('team_id')
            teamIdInput.value = team_id
            document.getElementById('addNewTodoForm').submit()
        })
    })
}
</script>

</html>