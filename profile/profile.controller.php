<?php

require_once "../helper/database.php";

class Profile
{

    public function getUser()
    {
        DB::Init();
        $sql = "SELECT u.* FROM user as u WHERE id =?";
        $stmt = DB::get()->stmt_init();
        if (!$stmt->prepare($sql)) {
            die("SQL error: " . DB::get()->error);
        }

        $stmt->bind_param("s", $_SESSION["user_id"]);

        if (!$stmt->execute()) {
            die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
        } else {
            $result = $stmt->get_result();
            $user = $result->fetch_all(MYSQLI_ASSOC);

            return $user;

        }
    }
}

$profile = new Profile();

$user = $profile->getUser();
