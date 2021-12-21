<?php
session_start();
header('Content-Type: application/json');
require_once 'verificator.php';
use verificator;

$email = htmlspecialchars($_POST["email"], ENT_QUOTES, ENT_SUBSTITUTE);

$verificator = new verificator();

$errors = [];

$result = $verificator->verificateLOG($email, $_POST["password"]);

if (!is_array($result))
{
    $_SESSION["id"] = $result;
    echo json_encode(["success" => true]);
}
else
{
    $_SESSION["log_error"] = $errors;
    echo json_encode(["errors" => $errors]);
}