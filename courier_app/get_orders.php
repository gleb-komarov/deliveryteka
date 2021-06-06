<?php
require '../db/config.php';

if ( empty($_GET['courier_id']) ) { // check GET data
    die(http_response_code(404));
}
else {
    $courier_id = $_GET['courier_id'];
}

function getOrders() { // берем данные заказов из БД по user_id
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `orders`.`order_id`, `orders`.`order_datetime`, `orders`.`order_total`, `orders`.`user_name`, `orders`.`user_address`, `orders`.`user_phone`, `orders`.`user_comment`,
        `order_statuses`.`order_status_name` AS `order_status`, `pay_methods`.`pay_method_name` AS `pay_method`
        FROM `orders`
        INNER JOIN `order_statuses` ON `order_statuses`.`order_status_id` = `orders`.`order_status_id`
        INNER JOIN `pay_methods` ON `pay_methods`.`pay_method_id` = `orders`.`pay_method_id`
        WHERE `orders`.`courier_id` IS NULL ORDER BY `orders`.`order_id` DESC;");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getOrderById($order_id) {
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `orders`.`order_id`, `orders`.`order_datetime`, `orders`.`order_total`, `orders`.`user_name`, `orders`.`user_address`, `orders`.`user_phone`, `orders`.`user_comment`,
        `order_statuses`.`order_status_name` AS `order_status`, `pay_methods`.`pay_method_name` AS `pay_method`
        FROM `orders`
        INNER JOIN `order_statuses` ON `order_statuses`.`order_status_id` = `orders`.`order_status_id`
        INNER JOIN `pay_methods` ON `pay_methods`.`pay_method_id` = `orders`.`pay_method_id`
        WHERE `orders`.`order_id` = '$order_id';");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getCourierActiveOrder($courier_id) {
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `couriers`.`active_order_id` FROM `couriers` WHERE `couriers`.`courier_id` = '$courier_id'");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

$active_order = getCourierActiveOrder($courier_id);

foreach ($active_order as $row) {
    $active_order_id = $row->active_order_id;
}

if ($active_order_id == NULL) {
    $orders = getOrders();

    $response = array(
        "is_active" => false,
        "result" =>$orders
    );
}
else {
    $order = getOrderById($active_order_id);

    $response = array(
        "is_active" => true,
        "result" =>$order
    );
}

print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
