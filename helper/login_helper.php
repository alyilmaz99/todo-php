<?php

require_once '../helper/database.php';
require_once '../helper/session_helper.php';
class LoginHelper
{

    private $email;
    private $password;
    private $is_valid;

    public function __construct($email, $password, $is_valid)
    {
        $this->email = $email;
        $this->password = $password;
        $this->is_valid = $is_valid;
    }

    public function Login()
    {
        DB::Init();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $sql = sprintf("SELECT * FROM user
            WHERE email = '%s'", DB::get()->real_escape_string($_POST["email"]));
            $result = DB::get()->query($sql);
            $user = $result->fetch_assoc();

            if ($user) {
                if (password_verify($_POST["password"], $user["password_hash"])) {
                    session_start();
                    session_regenerate_id();
                    $_SESSION["user_id"] = $user["id"];

                }
            }
            $this->is_valid = true;
            $session_helper = new SessionHelper($user);
            $session_helper->sessionStart();
            header("Location: ../index.php");
            exit;
        }

    }

}

$helper = new LoginHelper($_POST["email"], $_POST["password"], false);
$helper->Login();
