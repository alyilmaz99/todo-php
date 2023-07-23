<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
session_start();

class SessionHelper
{
    private $user;
    public function __construct($user)
    {
        $this->user = $user;
    }

    public function sessionStart()
    {
        if (isset($this->user)) {
            $_SESSION["user_id"] = $this->user["id"];
            $_SESSION["user_name"] = $this->user["name"];
            $_SESSION["user_email"] = $this->user["email"];
            $_SESSION["user_verification_code"] = $this->user["verification_code"];
        }
    }
    public function sessionDestroy()
    {
        session_destroy();
        header("Location: auth/login.php");
    }
}
