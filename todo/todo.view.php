<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();
require_once "todo.controller.php";
$todoController = new TodoController();
$members = $todoController->getMembers();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Todo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css" />
    <style>
    .dropbtn {
        background-color: #04AA6D;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
    </style>
</head>

<body>
    <?php if (isset($_SESSION['user_id'])): ?>
    <h1>Todo</h1>
    <form method="post" id='addNewTodoForm'>
        <input type="text" name="todo" id="todo" placeholder="todo" />
        <input type="hidden" name='team_id' id='team_id'>
        <div class="dropdown">
            <button type="submit" class="dropbtn">TEAM EKLE</button>
            <div class="dropdown-content">
                <?php
foreach ($members as $members) {
    echo "<a href='todo.controller.php' class='update-todo-team' data-id='" . $members['team_id'] . "'>" . $members["team"] . "</a>";}
?>
            </div>
        </div>
        <button type="submit">EKLE</button>
        </div>
    </form>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Team id</th>
                <th>User id</th>
                <th>Todo</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($todos as $todos): ?>
            <tr>
                <td><?php echo $todos["id"] ?></td>
                <td><?php if (!isset($todos["team_id"])) {
    echo " Team atanmadi";
} else {
    echo $todos["team"];
}?></td>
                <td><?php echo $todos["name"] ?></td>
                <td><?php echo $todos["task"] ?></td>
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