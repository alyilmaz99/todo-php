<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
require_once "../helper/database.php";
class Update
{

    public function updateTodo()
    {
        if (isset($_POST["id"])) {
            DB::Init();
            $sql = "UPDATE todo SET task = ? WHERE id = ?";
            $stmt = DB::get()->stmt_init();
            if (!$stmt->prepare($sql)) {
                die("SQL error: " . DB::get()->error);
            }

            $stmt->bind_param("sd", $_POST["update_todo"], $_POST["id"]);

            if (!$stmt->execute()) {
                die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
            }
        }

    }

}

if (isset($_POST['update_todo'])) {
    $update = new Update();

    $update->updateTodo();
    header("Location: todo.view.php");
}
