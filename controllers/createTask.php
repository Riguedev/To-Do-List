<?php
session_start();
require __DIR__ . "/../model/dataBase.php";

if(!isset($_SESSION["User"]["id"])) {
    header("Location: ../login.php");
    die();
}

if($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<h1>Opps</h1>";
    die();
}

$taskData = json_decode(file_get_contents('php://input'), true);

$taskData["creator_id"] = $_SESSION["User"]["id"];
$response = DataBaseConnection::createUserTask($taskData);

if($response !== false) {
    $_SESSION["User"]["tasks"][] = $response;
    header("Content-Type: Aplication-json");
    http_response_code(200);
    echo json_encode($response);
}
