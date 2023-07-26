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

    public function addTodos()
    {
        DB::Init();

        $sql = "INSERT INTO todo (user_id, task, team_id) VALUES (?, ?, ?)";
        $stmt = DB::get()->stmt_init();
        if (!$stmt->prepare($sql)) {
            die("SQL error: " . DB::get()->error);
        }

        if ($_POST["team_id"] == "0") {
            $_POST["team_id"] = "Team Atanmadi";
        }
        $stmt->bind_param("sss", $_SESSION["user_id"], $_POST["todo"], $_POST["team_id"]);
        if (!$stmt->execute()) {
            die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
        }
    }

    public function getTodos()
    {
        DB::Init();
        $sql = "SELECT t.*, u.name, te.team FROM todo as t LEFT JOIN user as u on u.id = t.user_id LEFT JOIN team as te on te.id = t.team_id WHERE t.user_id = ?";
        $stmt = DB::get()->stmt_init();
        if (!$stmt->prepare($sql)) {
            die("SQL error: " . DB::get()->error);
        }
        $stmt->bind_param("s", $_SESSION["user_id"]);
        if (!$stmt->execute()) {
            die("SQL error: " . $stmt->error . " Error number: " . DB::get()->errno);
        } else {
            $result = $stmt->get_result();
            $todos = $result->fetch_all(MYSQLI_ASSOC);
            return $todos;
        }

    }

}

$todoController = new TodoController();
if (isset($_POST["todo"])) {

    $todoController->addTodos();
    header("Location: todo.view.php");
    exit();
}
$todos = $todoController->getTodos();
