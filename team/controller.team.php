<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
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
        session_start();
        DB::Init();
        $sql = "INSERT INTO team_user (team_id, user_id) VALUES (?, ?)";
        $stmt = DB::get()->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL hatasi: " . DB::get()->error);
        }

        $stmt->bind_param("ss", $_POST['join'], $_SESSION['user_id']);

        if (!$stmt->execute()) {
            if (DB::get()->errno === 1062) {
                echo "Ayni takim zaten var";
            } else {
                die("SQL hatasi: " . $stmt->error . " Hata numarasi: " . DB::get()->errno);
            }
        } else {
            header("Location: view.team.php");
            exit;
        }
    }
    public function getMembers()
    {
        DB::Init();
        $sql = "SELECT * FROM team_user WHERE team_id = ?";

        $stmt = DB::get()->stmt_init();
        if (!$stmt->prepare($sql)) {
            die("SQL error: " . DB::get()->error);
        }

        $stmt->bind_param("i", $_POST["show"]);

        if (!$stmt->execute()) {
            die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
        } else {
            $result = $stmt->get_result();
            $members = $result->fetch_all(MYSQLI_ASSOC);

            header("Location: show.view.php?members=" . urlencode(json_encode($members)));
            exit();
        }
    }
    public function deleteMembers()
    {
        DB::Init();
        $sql = "DELETE FROM team_user WHERE id = ?";

        $stmt = DB::get()->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . DB::get()->error);
        }

        $stmt->bind_param("i", $_POST["deleteId"]);

        if (!$stmt->execute()) {
            die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
        } else {

            header("Location: view.team.php");
            exit();
        }
    }
    public function getSelectedTeamInfo($id)
    {
        DB::Init();
        $sql = "SELECT * FROM team";
        $result = DB::get()->query($sql);
        $teams = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($teams as $team) {
            if ($team["id"] == $id) {
                return $team['team'];
            }
        }

        return "Team not found";
    }

    public function getSelectedUserInfo($id)
    {
        DB::Init();
        $sql = "SELECT * FROM user";
        $result = DB::get()->query($sql);
        $user = $result->fetch_all(MYSQLI_ASSOC);
        if ($user == null) {
            echo "No teams";
        }
        foreach ($user as $user) {
            if ($user["id"] == $id) {
                return $user['name'];
            }
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
if (isset($_POST["show"])) {
    $team->getMembers();
}
if (isset($_POST["deleteId"])) {
    $team->deleteMembers();
}