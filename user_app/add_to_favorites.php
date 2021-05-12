<?php
require '../db/config.php';

if ( empty($_GET['user_id']) || empty($_GET['medicine_id'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
    $medicine_id = $_GET['medicine_id'];
}

function isExistUser($user_id) // проверка существования user_id
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function isExistMedicine($medicine_id) // проверка существования medicine_id
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `medicine` WHERE medicine_id = '$medicine_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function sameFavoritExists($user_id, $medicine_id) { // проверка на существование такого же препарата в избранных у пользователя
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `favorites` WHERE user_id = '$user_id' AND medicine_id = '$medicine_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

if (isExistUser($user_id) && isExistMedicine($medicine_id)) { //проверяем если user и medicine существуют
    if (sameFavoritExists($user_id, $medicine_id)) { // если избранное уже есть просто возвращаем массив с недобавленной медициной
        $response = array(
            "result" => isExistMedicine($medicine_id)
        );

        print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
    else {
        $pdo = getPdo(); // подключаемся к БД
        $query = $pdo->query("INSERT INTO `favorites` (`favorit_id` ,`user_id` ,`medicine_id`) VALUES (NULL ,  '$user_id',  '$medicine_id');"); // запрос

        $response = array(
            "result" => isExistMedicine($medicine_id)
        );

        print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

}
else {
    die(http_response_code(404));
}
