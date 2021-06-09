<?php
require '../function.php';

session_start();
if ( isset($_SESSION['login'])) { // проверям залогинен ли admin
    $admin_login = $_SESSION['login'];
}
else {
    header('Location: ../login'); // если не залогинен переходим на страницу логина
}

$order_id = $_GET['order_id'];
$courier_id = $_GET['courier_id'];

function removeOrderWithActiveOrderCourier($order_id, $courier_id) {
    $pdo = getPdo(); // подключаемся к БД
    $query = $pdo->query("UPDATE `orders` SET `courier_id`= NULL, `order_status_id` = 1 WHERE  `order_id` = '$order_id';
    UPDATE `couriers` SET `active_order_id` = NULL WHERE `courier_id` = '$courier_id';");
}

function removeOrder($order_id) {
    $pdo = getPdo(); // подключаемся к БД
    $query = $pdo->query("UPDATE `orders` SET `order_status_id` = 1 WHERE  `order_id` = '$order_id';");
}

if ( $courier_id == "" ) {
    removeOrder($order_id);
}
else {
    removeOrderWithActiveOrderCourier($order_id, $courier_id);
}

header('Location: orders.php');
