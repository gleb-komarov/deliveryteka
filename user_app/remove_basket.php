<?php
require '../db/config.php';

if ( empty($_GET['user_id']) && empty($_GET['medicine_id'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
    $medicine_id = $_GET['medicine_id'];
}

function isExistUserBasket($user_id, $medicine_id){ // проверка существования user_id
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `basket` WHERE user_id = '$user_id' AND medicine_id = '$medicine_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function removeBasket($user_id, $medicine_id){
    $pdo = getPdo();
    $query = $pdo->query("DELETE FROM `basket` WHERE user_id = '$user_id' AND medicine_id = '$medicine_id';"); // выполнение sql запроса
}

if (isExistUserBasket($user_id, $medicine_id)) { // проверяем если user basket существует то удалить
    removeBasket($user_id, $medicine_id);
}
else {
    die(http_response_code(404));
}
