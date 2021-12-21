<?php
session_start();
header('Content-Type: application/json');
require_once 'verificator.php';


$email = htmlspecialchars($_POST["email"], ENT_QUOTES, ENT_SUBSTITUTE);
$name = htmlspecialchars($_POST["name"], ENT_QUOTES, ENT_SUBSTITUTE);
$phone = htmlspecialchars($_POST["phone"], ENT_QUOTES, ENT_SUBSTITUTE);

$verificator = new verificator();

$errors = [];

$errors = $verificator->verificateREG($email, $phone, $_POST["password"], $_POST["passwordRepeat"], $name);

if (empty($errors))
{
    $ini_array = parse_ini_file('parameters.ini');
    $pdo = new PDO
    (
        'pgsql:host=' . $ini_array['host'] .
        ';port=' . $ini_array['port'] .
        ';dbname=' . $ini_array['name'] .
        ';user=' . $ini_array['login'] .
        ';password=' . $ini_array['password']);
    $hashPass = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $query = "INSERT INTO usr(phone, email, name, password) 
            VALUES 
            (:phone, :email, :name, :hashPass)
            RETURNING id";
    $result = $pdo->prepare($query);
    $result->bindParam(':email', $email);
    $result->bindParam(':phone', $phone);
    $result->bindParam(':name', $name);
    $result->bindParam(':hashPass', $hashPass);
    $result->execute();
    $data = $result->fetchAll();
    $id = $data[0]["id"];
    $_SESSION["id"] = $id;
    echo json_encode(["success" => true]);
}
else
{
    $_SESSION["reg_error"] = $errors;
    echo json_encode(["errors" => $errors]);
}