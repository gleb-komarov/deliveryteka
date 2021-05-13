<?php
require '../db/config.php';

if ( empty($_GET['user_id']) ) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
}

function isExistUser($user_id) // проверка существования user_id в БД
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getUserById($user_id){
    $pdo = getPdo();
    $query = $pdo->query("SELECT `users`.`user_phone`, `users`.`user_name`, `users`.`user_adress`, `med_cards`.`med_card_number` 
    FROM `users` 
    LEFT JOIN `med_cards` ON `users`.`user_med_card_id` = `med_cards`.`med_card_id`
    WHERE `users`.`user_id` = '$user_id'");
    return $query->fetchAll(PDO::FETCH_OBJ); 
}

if (isExistUser($user_id)) { // если user существует
    $array = getUserById($user_id);

    $response = array(
        "result" =>$array
    );

    print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ));
}
else {
    echo "404";
}
