<?php
require '../db/config.php';

if ( empty($_GET['courier_id']) || empty($_GET['order_id']) ) { // check GET data
    die(http_response_code(404));
}
else {
    $courier_id = $_GET['courier_id'];
    $order_id = $_GET['order_id'];
}

function acceptOrder($courier_id, $order_id) {
    $pdo = getPdo();
    $query = $pdo->query("UPDATE `orders` SET `courier_id`= '$courier_id' WHERE  `order_id` = '$order_id';
    UPDATE `couriers` SET `active_order_id`= '$order_id',  WHERE  `courier_id` = '$courier_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}
