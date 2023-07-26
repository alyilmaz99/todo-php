<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
require_once "../helper/database.php";
session_start();
class Update
{
    public static $catcher;
    public function updateTodo()
    {
        if (isset($_POST["update_todo"])) {
            DB::Init();
            $sql = "UPDATE todo SET task = ? WHERE id = ?";
            $stmt = DB::get()->stmt_init();
            if (!$stmt->prepare($sql)) {
                die("SQL error: " . DB::get()->error);
            }

            $stmt->bind_param("ss", $_POST["update_todo"], $this->catcher);

            if (!$stmt->execute()) {
                die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
            }
        }
        header("Location: todo.view.php");
    }

}

if (isset($_POST['update-page'])) {

    $update->$catcher = $_POST['update-page'];

    header("Location: update.view.php");
}
if (isset($_POST['update_todo1'])) {
    $update = new Update();
    $update->updateTodo();

}
