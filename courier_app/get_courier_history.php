<?php
require '../db/config.php';

if ( empty($_GET['courier_id']) ) { // check GET data
    die(http_response_code(404));
}
else {
    $courier_id = $_GET['courier_id'];
}

function getCourierHistory($courier_id) { // берем данные заказов из БД по user_id
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `orders`.`order_id`, `orders`.`order_datetime`, `orders`.`courier_salary` FROM `orders`
        WHERE DATEDIFF(order_datetime, CURRENT_DATE()) < 7 AND `orders`.`courier_id` = '$courier_id' ORDER BY `orders`.`order_id` DESC;");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

$courier_history = getCourierHistory($courier_id);

$response = array(
    "result" =>$courier_history
);

print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
