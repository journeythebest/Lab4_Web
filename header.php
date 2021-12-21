<?php
if (!isset($_SESSION["id"]))
{
    $text = '
        <a href="index.php">
            Kinopoisk killer
        </a>
        <div class="login-button" id="header_login_button">
            Вход
        </div>';
}
else
{
    $ini_array = parse_ini_file('parameters.ini');
    $pdo = new PDO
    (
        'pgsql:host=' . $ini_array['host'] .
        ';port=' . $ini_array['port'] .
        ';dbname=' . $ini_array['name'] .
        ';user=' . $ini_array['login'] .
        ';password=' . $ini_array['password']);
    $query = "SELECT name 
            FROM usr
            WHERE id = :id";
    $result = $pdo->prepare($query);
    $result->bindParam(':id', $_SESSION["id"], PDO::PARAM_INT);
    $result->execute();
    $data = $result->fetchAll(PDO::FETCH_ASSOC);
    $text = '
        <a href="index.php">
            Kinopoisk killer
        </a>
        <div>
            Здравствуй, ' . $data[0]["name"] . '
        </div>
        <div onclick="out()">
            Выход
        </div>';
}
echo $text;