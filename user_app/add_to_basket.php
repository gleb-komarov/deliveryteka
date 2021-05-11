<?php
require '../db/config.php';

if ( empty($_GET['user_id']) || empty($_GET['medicine_id']) || empty($_GET['count'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
    $medicine_id = $_GET['medicine_id'];
    $count = $_GET['count'];
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

function sameMedicineExists($user_id, $medicine_id) { // проверка на существование такого же препарата в корзине у пользователя
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `basket` WHERE user_id = '$user_id' AND medicine_id = '$medicine_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getSumByMedicineId($medicine_id, $count) {
    $medicine = isExistMedicine($medicine_id);
    $sum = 0;
    foreach ($medicine as $row) {
        $sum = $row->medicine_price * $count;
    }
    return $sum;
}

if (isExistUser($user_id) && isExistMedicine($medicine_id)) { //проверяем если user и medicine существуют то добавляем в корзину
    $sum = getSumByMedicineId($medicine_id, $count);
    if (sameMedicineExists($user_id, $medicine_id)) { // если такой товар в корзине есть обновляем его
        $pdo = getPdo(); // подключаемся к БД
        $query = $pdo->query("UPDATE `basket` SET `count` = '$count', `sum` = '$sum' WHERE user_id = '$user_id' AND medicine_id = '$medicine_id';"); // запрос

        $response = array(
            "result" => isExistMedicine($medicine_id)
        );

        print_r(json_encode( $response , JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
    else { // если нет
        $pdo = getPdo(); // подключаемся к БД
        $query = $pdo->query("INSERT INTO `basket` (`basket_id` ,`user_id` ,`medicine_id`, `count`, `sum`) VALUES (NULL ,  '$user_id',  '$medicine_id', '$count', '$sum');"); // запрос

        $response = array(
            "result" => isExistMedicine($medicine_id)
        );

        print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }
}
else {
    die(http_response_code(404));
}
