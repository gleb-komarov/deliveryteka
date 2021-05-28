<?php
require '../db/config.php';

if ( empty($_GET['user_id'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
}

function isExistUser($user_id) // проверка существования user_id в БД
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getOrdersByUserId($user_id) { // берем данные заказов из БД по user_id
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `orders`.`order_id`, `orders`.`order_datetime`, `orders`.`order_total`, `order_statuses`.`order_status_name` AS `order_status`, `pay_methods`.`pay_method_name` AS `pay_method`
        FROM `orders`
        INNER JOIN `order_statuses` ON `order_statuses`.`order_status_id` = `orders`.`order_status_id`
        INNER JOIN `pay_methods` ON `pay_methods`.`pay_method_id` = `orders`.`pay_method_id`
        WHERE `orders`.`user_id` = '$user_id' ORDER BY `orders`.`order_id` DESC;"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

if (isExistUser($user_id)) { // если пользователь есть, то отправляем клиенту

    $orders = getOrdersByUserId($user_id);

    $response = array(
        "result" =>$orders,
    );

    print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
else {
    die(http_response_code(404));
}
