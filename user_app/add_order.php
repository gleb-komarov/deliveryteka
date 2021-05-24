<?php
require '../db/config.php';

if ( empty($_GET['user_id']) || empty($_GET['user_name']) || empty($_GET['user_address']) || empty($_GET['user_phone']) || empty($_GET['pay_method'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
    $user_name = $_GET['user_name'];
    $user_address = $_GET['user_address'];
    $user_phone = $_GET['user_phone'];
    $user_comment = $_GET['user_comment'];
    $pay_method = $_GET['pay_method'];
}

function isExistUser($user_id) // проверка существования user_id
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function addOrder ($user_id, $datetime, $user_name, $user_address, $user_phone, $user_comment, $pay_method, $total) {
    $pdo = getPdo();
    $query = $pdo->query("INSERT INTO `orders` (`order_id` , `order_datetime`, `courier_id` ,`order_status_id`, `user_id`, `user_name`, `user_address`, `user_phone`, `user_comment`, `pay_method_id`, `order_total`) 
    VALUES (NULL , '$datetime', 1, 2, '$user_id', '$user_name', '$user_address', '$user_phone', '$user_comment', '$pay_method', '$total');");
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

function getBaskeySumByUserId($user_id) { // берем данные корины из БД по user_id
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `basket`.`sum` FROM `basket` WHERE `basket`.`user_id` = '$user_id'"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

if (isExistUser($user_id)) { //проверяем если user и medicine существуют то добавляем в корзину
    date_default_timezone_set('Europe/Minsk'); // находим время заказа
    $datetime = date('Y-m-d H:i:s', time());

    $basket = getBaskeySumByUserId($user_id);

    foreach ($basket as $row) { // считаем сумму заказа из корзнины
        $total += $row->sum;
    }
    round($total,2);

    addOrder($user_id, $datetime, $user_name, $user_address, $user_phone, $user_comment, $pay_method, $total); // добавляем заказ в БД
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
