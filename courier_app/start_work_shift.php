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

function updateCourierInfo ($courier_id, $hours) {
    $pdo = getPdo();
    $query = $pdo->query("UPDATE `couriers` SET `is_online`= 1 WHERE  `courier_id` = '$courier_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getCourierWorkShift($courier_id) {
    $pdo = getPdo();
    $query = $pdo->query("SELECT SUBSTRING(`work_shifts`.`start_work_shift` FROM 12 FOR 5) AS `start_work_shift`,SUBSTRING(`work_shifts`.`end_work_shift` FROM 12 FOR 5) AS `end_work_shift` FROM `work_shifts` 
    WHERE `work_shifts`.`work_shift_id` =  (SELECT MAX(`work_shift_id`) AS 'ID' FROM `work_shifts` WHERE `work_shifts`.`courier_id` = '$courier_id')"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

if (isExistCourier($courier_id)) {
    $start_sql = date("Y-m-d ") . (date("H")+1 . date(":i:s")) ;
    $end_sql = date("Y-m-d ") . (date("H")+1+$hours . date(":i:s"));

    startWorkShift($courier_id, $start_sql, $end_sql);

    $work_shift = getCourierWorkShift($courier_id);

    print_r(json_encode($work_shift, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));

} else {
    die(http_response_code(404));
}
