<?php
require '../db/config.php';

if ( empty($_GET['courier_id'])) { // check GET data
    die(http_response_code(404));
}
else {
    $courier_id = $_GET['courier_id'];
}

function isOnlineCourier($courier_id) {
    $pdo = getPdo();
    $query = $pdo->query("SELECT `courier_id`, `is_online` FROM `couriers` WHERE courier_id = '$courier_id' AND is_online = 1;"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getCourierWorkShift($courier_id) {
    $pdo = getPdo();
    $query = $pdo->query("SELECT SUBSTRING(`work_shifts`.`start_work_shift` FROM 12 FOR 5) AS `start_work_shift`,SUBSTRING(`work_shifts`.`end_work_shift` FROM 12 FOR 5) AS `end_work_shift` FROM `work_shifts` 
    WHERE `work_shifts`.`work_shift_id` =  (SELECT MAX(`work_shift_id`) AS 'ID' FROM `work_shifts` WHERE `work_shifts`.`courier_id` = '$courier_id')"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

if (isOnlineCourier($courier_id)) {

    $work_shift = getCourierWorkShift($courier_id);

    print_r(json_encode($work_shift, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
} else {

    $response = [
        "0" => [
            "start_work_shift" => "",
            "end_work_shift" => "",
        ],
    ];

    print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}