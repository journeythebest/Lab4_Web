<?php
$ini_array = parse_ini_file('parameters.ini');
$pdo = new PDO
(
    'pgsql:host=' . $ini_array['host'] .
    ';port=' . $ini_array['port'] .
    ';dbname=' . $ini_array['name'] .
    ';user=' . $ini_array['login'] .
    ';password=' . $ini_array['password']);
$query = "SELECT id, review_name, poster, review_date 
            FROM review 
            offset :count 
            limit 10";
$result = $pdo->prepare($query);
$result->bindParam(':count', $_GET["count"], PDO::PARAM_INT);
$result->execute();
$rows = $result->fetchAll(PDO::FETCH_ASSOC);
    $review = [];
    foreach ($rows as $row) {
        $review[] = '<div class="review">
                        <img src="img/' . $row["poster"] . '">
                        <a class = "title" href="review.php?id=' . $row["id"] . '">' . $row["review_name"] . '</a>
                        <span class="date">' . $row["review_date"] . '</span>
                        <a class ="review-button" href="review.php?id=' . $row["id"] . '">ПЕРЕЙТИ</a>
                     </div>';
    }
    echo json_encode($review);
