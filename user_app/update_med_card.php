<?php
require '../db/config.php';

if ( empty($_GET['user_id']) || empty($_GET['med_card_number'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
    $med_card_number = $_GET['med_card_number'];
}

function isExistUser($user_id) // проверка существования user_id
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT `users`.`user_id`, `users`.`med_card_number` FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

if (isExistUser($user_id)) { //проверяем если user существует то обновляем медкарту
    $pdo = getPdo(); // подключаемся к БД
    $query = $pdo->query("UPDATE `users` SET `med_card_number` = '$med_card_number' WHERE user_id = '$user_id';"); // запрос

    $response = array(
        "result" => isExistUser($user_id)
    );

    print_r(json_encode( $response , JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
else {
    die(http_response_code(404));
}
