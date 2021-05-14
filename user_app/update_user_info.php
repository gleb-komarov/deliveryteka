<?php
require '../db/config.php';

if ( empty($_GET['user_id']) || empty($_GET['user_name']) || empty($_GET['user_address'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
    $user_name = $_GET['user_name'];
    $user_address = $_GET['user_address'];
}

function isExistUser($user_id) // проверка существования user_id
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT `users`.`user_id`, `users`.`user_name`, `users`.`user_address` FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

if (isExistUser($user_id)) { //проверяем если user и medicine существуют то добавляем в корзину
    $pdo = getPdo(); // подключаемся к БД
    $query = $pdo->query("UPDATE `users` SET `user_name` = '$user_name', `user_address` = '$user_address' WHERE user_id = '$user_id';"); // запрос

    $response = array(
        "result" => isExistUser($user_id)
    );

    print_r(json_encode( $response , JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
else {
    die(http_response_code(404));
}
