<?php
session_start();

require_once __DIR__ . "/dataValidation.php";
require_once __DIR__ . "/../model/dataBase.php";

if($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo "<h1>Ops algo salío mal</h1>";
    die();
}

$userData = [
  "email" => $_POST["email"],
  "pass" => $_POST["pass"]
];

$validationList = DataValidation::validateLogin($userData);

if($validationList !== true) {
    http_response_code(404);
    $link = "../login.php";
    require __DIR__ . '/../views/registerError.php';
    die();
}

$userData["pass"] = hash("sha256", $userData["pass"]);

$dbUserData = DataBaseConnection::loginUser($userData);

if(empty($dbUserData)) {
    http_response_code(400);
    header("Location: ../login.php");
    die();
}

$_SESSION["User"] = array(
    "id" => $dbUserData["user_id"],
    "name" => $dbUserData["name"],
    "email" => $dbUserData["email"],
    "tasks" => $userTasks = DataBaseConnection::getUserTask($dbUserData["user_id"])
);

header("Location: ../views/home.php");