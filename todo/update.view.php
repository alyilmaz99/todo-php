<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();
require_once "todo.controller.php";
require_once "update.controller.php";
$todoController = new TodoController();

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
    <h1>Todo Update</h1>
    <?php var_dump($_GET['id']);?>
    <div>
        <form action="update.controller.php" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
            <input type="text" name="update_todo" placeholder="update_todo" />
            <button type="submit">Update</button>
        </form>
    </div>


    <?php else: ?>
    <div>
        <?php header("Location: ../auth/login.php")?>

    </div>
    <?php endif;?>
</body>

</html>