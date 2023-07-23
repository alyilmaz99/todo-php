<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();
require_once 'controller.team.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teams Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css" />
</head>

<body>
    <h1>Teams Page</h1>
    <form action="controller.team.php" method="post">
        <label for="name">Name</label>
        <input type="text" name="team_name" id="team_name">
        <button>Add Team</button>
    </form>


    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($teams as $teams): ?>
            <tr>
                <td><?php echo $teams["id"] ?></td>
                <td><?php echo $teams["team"]; ?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</body>

</html>