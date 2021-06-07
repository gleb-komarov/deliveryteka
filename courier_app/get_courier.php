<?php
require '../db/config.php';

if ( empty($_GET['courier_id']) ) { // check GET data
    die(http_response_code(404));
}
else {
    $courier_id = $_GET['courier_id'];
}

function getCourier($courier_id) { // берем данные заказов из БД по user_id
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `couriers`.`courier_phone`, `couriers`.`courier_name`, `couriers`.`all_shifts`, `couriers`.`all_hours`,
        (SELECT COUNT(`order_id`) FROM `orders` WHERE `orders`.`courier_id`= '$courier_id' AND `orders`.`order_status_id`= 5) AS `all_orders`,
        (SELECT SUM(`courier_salary`) FROM `orders` WHERE `orders`.`courier_id`= '$courier_id' AND `orders`.`order_status_id`= 5) AS `all_salary`
        FROM `couriers` WHERE `courier_id` = '$courier_id';");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

$courier_info = getCourier($courier_id);

foreach ($courier_info as $row) {
    if ($row->all_salary == NULL) {
        $row->all_salary = 0;
    }
}

$response = array(
    "result" =>$courier_info
);


print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
