<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();
require_once 'controller.team.php';
if (isset($_GET['members'])) {
    $members = json_decode($_GET['members'], true);

}
$newTeamClass = new Team();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Team Members</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css" />
</head>

<body>
    <h1>Members Page</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Team id</th>
                <th>User id</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($members != null) {
    ;
}
?>
            <?php foreach ($members as $members): ?>
            <tr>
                <td><?php echo $members["id"] ?></td>
                <td><?php echo $newTeamClass->getSelectedTeamInfo($members["team_id"]) ?></td>
                <td><?php echo $newTeamClass->getSelectedUserInfo($members["user_id"]) ?></td>
                <td>
                    <form action="controller.team.php" method="post">
                        <input type="hidden" name="deleteId" value="<?php echo $members["id"] ?>">
                        <button type="submit" name="deleteName">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endforeach;?>



        </tbody>
    </table>
    <a href="view.team.php">Team Page</a>
    <br>
    <a href="../index.php">Anasayfa</a>
</body>

</html>