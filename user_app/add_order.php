<?php
require '../db/config.php';

if ( empty($_GET['user_id']) || empty($_GET['user_name']) || empty($_GET['user_address']) || empty($_GET['user_phone']) || empty($_GET['user_comment'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
    $user_name = $_GET['user_name'];
    $user_address = $_GET['user_address'];
    $user_phone = $_GET['user_phone'];
    $user_comment = $_GET['user_comment'];
}

function isExistUser($user_id) // проверка существования user_id
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function addOrder ($user_id, $user_name, $user_address, $user_phone, $user_comment) {
    $pdo = getPdo();
    $query = $pdo->query("INSERT INTO `orders` (`order_id` ,`courier_id` ,`order_status_id`, `user_id`, `user_name`, `user_address`, `user_phone`, `user_comment`) 
    VALUES (NULL , NULL, 2, '$user_id',  '$user_name', '$user_address', '$user_phone', '$user_comment');");
}

function getOrderId ($user_id) {
    $pdo = getPdo();
    $query = $pdo->query("SELECT MAX(`order_id`) AS 'order_id' FROM `orders` WHERE `orders`.`user_id` = '$user_id'"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function addOrderContentAndClearBasket($user_id, $order_id) {
    $pdo = getPdo();
    $query = $pdo->query("INSERT INTO `order_content` (`order_content_id`, `order_id`, `medicine_id`, `count`, `sum`)
    SELECT NULL, '$order_id', `medicine_id`, `count`, `sum` FROM `basket`
    WHERE `basket`.`user_id` = '$user_id';
	DELETE FROM `basket` WHERE `basket`.`user_id` = '$user_id';");
}


if (isExistUser($user_id)) { //проверяем если user и medicine существуют то добавляем в корзину
    addOrder($user_id, $user_name, $user_address, $user_phone, $user_comment);
    $order_array = getOrderId($user_id);
    $order_id = 0;
    foreach ($order_array as $row) {
        $order_id = $row->order_id;
    }
    addOrderContentAndClearBasket($user_id, $order_id);
}
else {
    die(http_response_code(404));
}
