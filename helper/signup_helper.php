<?php

class SignUp
{

    public $name;
    private $email;
    private $password;
    private $password_confirmation;

    public function __construct($name, $email, $password, $password_confirmation)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->password_confirmation = $password_confirmation;

    }

    public function add()
    {
        $password_hash = password_hash($this->password, PASSWORD_DEFAULT);
        DB::Init();
        $sql = "INSERT INTO user(name,email,verification_code,password_hash)
        VALUES (?,?,?,?)";
        $verification_code = "00";
        $stmt = DB::get()->stmt_init();

        if (!$stmt->prepare($sql)) {
            die("SQL error: " . DB::get()->error);
        }

        $stmt->bind_param("ssss", $this->name, $this->email, $verification_code, $password_hash);

        if (!$stmt->execute()) {
            if (DB::get()->errno === 1062) {
                echo "Same email already exists";
            } else {
                die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
            }
        } else {

            header("Location: login.php
            ");
            exit;
        }
    }

}
