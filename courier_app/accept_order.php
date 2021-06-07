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
    $query = $pdo->query("UPDATE `orders` SET `courier_id`= '$courier_id', `order_status_id` = `order_status_id` + 1 WHERE  `order_id` = '$order_id' AND `order_status_id` IN (2,3,4);
    UPDATE `couriers` SET `active_order_id`= '$order_id'  WHERE  `courier_id` = '$courier_id';
    UPDATE  `couriers` SET `active_order_id`= NULL WHERE (SELECT `orders`.`order_status_id` FROM `orders` WHERE `order_id` = '$order_id') IN (1,5)"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

acceptOrder($courier_id, $order_id);
