<?php
require_once __DIR__ . "/../model/dataBase.php";

session_start();

if(isset($_SESSION["User"]) !== true) {
    header("Location: ../login.php");
    die();
}

if($_SERVER["REQUEST_METHOD"] !== "PUT") {
    die("Solicitud no Valida");
}

$data = json_decode(file_get_contents("php://input"), true);
$equal = [];

foreach($_SESSION["User"]["tasks"] as $task) {
    if($task["task_id"] == $data["task_id"]) {
        $equal[] = $task["task_id"];
    }
}

if(count($equal) !== 1 || isset($data["task_id"]) !== true || isset($data["complete"]) !== true) {
    http_response_code(400);
    print_r($equal);
    die();
}

$updatedTask = DataBaseConnection::updateTaskState($data);

foreach($_SESSION["User"]["tasks"] as &$update) {
    if($update["task_id"] === $updatedTask["task_id"]) {
        $update["complete"] = $updatedTask["complete"];
    }
}

$response = [
    "message" => "Se actualizo correctamente",
    "taskInfo" => $updatedTask
];

header("Content-Type: application/json");
http_response_code(200);
echo json_encode($response);

