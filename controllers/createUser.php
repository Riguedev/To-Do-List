<?php
require __DIR__ . '/../controllers/dataValidation.php';
require __DIR__ . '/../model/dataBase.php';

if($_SERVER["REQUEST_METHOD"] != "POST") {
    die();
}

$userData = [
    "name" => $_POST["name"],
    "email" => $_POST["email"],
    "pass" => $_POST["pass"],
    "vpass" => $_POST["vpass"]  
];

$validationList = DataValidation::validateNewUser($userData);

if($validationList !== true) {
    http_response_code(404);
    $link = "../signUp.php";
    require __DIR__ . '/../views/registerError.php';
    die();
}

$userData["pass"] = hash("sha256", $_POST["pass"]);

if(DataBaseConnection::createUser($userData)) {
    header("Location: ../login.php");
    exit();
}
