<?php

require_once "../helper/database.php";
require_once "../helper/session_helper.php";

class Profile
{

    public function getUser()
    {
        DB::Init();
        $sql = "SELECT * FROM user WHERE id =?";
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
    public function updateProfile($user)
    {
        $userName = isset($_POST["name"]) && $_POST["name"] !== "" ? $_POST["name"] : $user[0]["name"];
        $email = isset($_POST["email"]) && $_POST["email"] !== "" ? $_POST["email"] : $user[0]["email"];

        $sql = "UPDATE user SET name = ?, email = ? WHERE id = ?";
        $stmt = DB::get()->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("Sql err0r: " . $stmt->error . " Error number: " . DB::get()->errno);
        }

        $stmt->bind_param("sss", $userName, $email, $user[0]["id"]);

        if (!$stmt->execute()) {
            die("sql error: " . $stmt->error . " error number: " . DB::get()->errno);
        }
    }

}

$profile = new Profile();

$user = $profile->getUser();

if (isset($_POST['email'])) {

    $profile->updateProfile($user);

    header('Location: ../../auth/login.php');
    $session = new SessionHelper($user);
    $session->sessionDestroy();
}
