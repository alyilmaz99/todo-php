<?php
require_once "../helper/database.php";

class TodoController
{

    public function getMembers()
    {
        DB::Init();
        $sql = "SELECT tu.*, t.team FROM team_user as tu LEFT JOIN team as t on t.id = tu.team_id WHERE tu.user_id = ?";

        $stmt = DB::get()->stmt_init();
        if (!$stmt->prepare($sql)) {
            die("SQL error: " . DB::get()->error);
        }

        $stmt->bind_param("s", $_SESSION["user_id"]);

        if (!$stmt->execute()) {
            die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
        } else {
            $result = $stmt->get_result();
            $members = $result->fetch_all(MYSQLI_ASSOC);

            return $members;

        }
    }

}
