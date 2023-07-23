<?php

require_once '../helper/database.php';
class Team
{
    public function getTeams()
    {

        DB::Init();
        $sql = "SELECT * FROM team";
        $result = DB::get()->query($sql);
        $teams = $result->fetch_all(MYSQLI_ASSOC);
        if ($teams == null) {
            echo "No teams";
        }

        return $teams;

    }
    public function AddTeam()
    {
        DB::Init();
        $sql = "INSERT INTO team (team)  VALUES (?)";
        $stmt = DB::get()->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . DB::get()->error);
        }

        $stmt->bind_param("s", $_POST["team_name"]);

        if (!$stmt->execute()) {
            if (DB::get()->errno === 1062) {
                echo "Same team exists";
            } else {
                die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
            }
        } else {

            header("Location: view.team.php
            ");
            exit;
        }
    }
    public function deleteTeam()
    {
        DB::Init();
        $sql = "DELETE FROM team WHERE id = ?";
        $stmt = DB::get()->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . DB::get()->error);
        }

        $stmt->bind_param("i", $_POST["id"]);

        if (!$stmt->execute()) {
            die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
        } else {
            header("Location: view.team.php
            ");
            exit;
        }
    }
    public function joinTeam()
    {
        DB::Init();
        $sql = "INSERT INTO team_user (team_id,user_id)  VALUES (?,?)";
        $stmt = DB::get()->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . DB::get()->error);
        }
        die(var_dump([$_POST["join"], $_SESSION["user_id"]]));
        $stmt->bind_param("ss", $_POST["join"], $_SESSION["user_id"]);

        if (!$stmt->execute()) {
            if (DB::get()->errno === 1062) {
                echo "Same team exists";
            } else {
                die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
            }
        } else {

            header("Location: view.team.php
            ");
            exit;
        }
    }

}

$team = new Team();
$teams = $team->getTeams();
if (isset($_POST["team_name"])) {
    $team->AddTeam();
}
if (isset($_POST["delete"])) {
    $team->deleteTeam();
}
if (isset($_POST["join"])) {
    $team->joinTeam();
}
