<?php
session_start();

if(!isset($_SESSION["User"])){
    header("Location: ../login.php");
    die();
}

if($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(400);
    header("Location: ../views/home.php");
    die();
}

session_unset();
session_destroy();

header("Location: ../index.php");

