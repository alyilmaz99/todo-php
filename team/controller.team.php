<?php
session_start();
class Team
{
    public function getTeams()
    {
        if (!isset($_SESSION["teams"])) {
            DB::Init();
            $sql = "SELECT * FROM team";
            $result = DB::get()->query($sql);
            $teams = $result->fetch_all(MYSQLI_ASSOC);
            return $teams;
        } else {
            return $_SESSION["teams"];
        }

    }
}
