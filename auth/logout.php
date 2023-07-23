<?php
ini_set('display_errors', true);
error_reporting(E_ALL);

require_once '../helper/session_helper.php';

$newSession = new SessionHelper($user);

$newSession->sessionDestroy();

header("Location: login.php");
