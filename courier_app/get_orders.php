<?php
require '../db/config.php';

function getOrdersByUserId() { // берем данные заказов из БД по user_id
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

$orders = getOrdersByUserId();

$response = array(
    "result" =>$orders,
);

print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
