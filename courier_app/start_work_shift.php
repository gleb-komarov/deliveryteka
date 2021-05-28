<?php
require '../db/config.php';

if ( empty($_GET['courier_id']) || empty($_GET['hours'])) { // check GET data
    die(http_response_code(404));
}
else {
    $courier_id = $_GET['courier_id'];
    $hours = $_GET['hours'];
}

function isExistCourier($courier_id) {
    $pdo = getPdo();
    $query = $pdo->query("SELECT `courier_id`, `courier_phone` FROM `couriers` WHERE courier_id = '$courier_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function startWorkShift($courier_id, $start_sql, $end_sql) {
    $pdo = getPdo();
    $query = $pdo->query("UPDATE `couriers` SET `is_online`= 1 WHERE  `courier_id` = '$courier_id';
    INSERT INTO `work_shifts` (`work_shift_id`, `courier_id`, `start_work_shift`, `end_work_shift`)
    VALUES (NULL, '$courier_id', '$start_sql', '$end_sql');"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

if (isExistCourier($courier_id)) {
    $start = date("H")+1 . date(":i") ;   // вычисляам начало смены и конец в формате для клиента и в формате datetime sql
    $end = date("H")+1+$hours . date(":i");

    $start_sql = date("Y-m-d ") . (date("H")+1 . date(":i:s")) ;
    $end_sql = date("Y-m-d ") . (date("H")+1+$hours . date(":i:s"));

    startWorkShift($courier_id, $start_sql, $end_sql);

    $response = array(
        "start_shift" =>$start,
        "end_shift" =>$end
    );

    print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
} else {
    die(http_response_code(404));
}