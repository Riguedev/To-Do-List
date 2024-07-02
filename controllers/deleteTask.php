<?php 

require __DIR__ . "/../model/dataBase.php";

session_start();

if(!isset($_SESSION["User"]["id"])) {
    header("Location: ../login.php");
    die();
}

if($_SERVER["REQUEST_METHOD"] != "DELETE") {
    http_response_code(400);
    echo json_encode([
        "message" => "El metodo no es valido",
        "success" => false
    ]);
    die();
}

$task = json_decode(file_get_contents("php://input"), true);

if(DataBaseConnection::deleteTask($task["task_id"], $_SESSION["User"]["id"]) !== true) {
    header("Content-Type: application/json");
    http_response_code(500);
    echo json_encode([
        "message" => "Ocurrio un problema, intenta en otro momento",
        "success" => false,
    ]);
    die();
}

foreach ($_SESSION["User"]["tasks"] as $key => $sessionTask) {
    if ($sessionTask["task_id"] == $task["task_id"]) {
        unset($_SESSION["User"]["tasks"][$key]);
    }
}

$_SESSION["User"]["tasks"] = array_values($_SESSION["User"]["tasks"]);

header("Content-Type: application/json");
http_response_code(200);
echo json_encode([
    "message" => "La tarea se borro exitosamente",
    "success" => true,
    "task_id" => $task["task_id"]
]);
