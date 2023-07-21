<?php

ini_set('display_errors', true);
error_reporting(E_ALL);
require_once '../helper/database.php';
require_once '../helper/signup_helper.php';

$signUp = new SignUp($_POST["name"], $_POST["email"], $_POST["password"], $_POST["password_confirmation"]);

$signUp->add();