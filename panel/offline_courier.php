<?php
require '../function.php';

session_start();
if ( isset($_SESSION['login'])) { // проверям залогинен ли admin
    $admin_login = $_SESSION['login'];
}
else {
    header('Location: ../login'); // если не залогинен переходим на страницу логина
}

$courier_id = $_GET['courier_id'];

function offlineCourier($courier_id) {
    $pdo = getPdo(); // подключаемся к БД
    $query = $pdo->query("UPDATE `couriers` SET is_online = 0  WHERE `courier_id` = '$courier_id';");
}

function setEndWorkShift($courier_id) {
    $end_time = date("Y-m-d ");

    $pdo = getPdo(); // подключаемся к БД
    $query = $pdo->query("UPDATE `work_shifts` SET `end_work_shift` = '$end_time' WHERE `work_shifts`.`work_shift_id` = 
    (SELECT MAX(`work_shifts`.`work_shift_id`) FROM `work_shifts` WHERE `work_shifts`.`courier_id`= '$courier_id');");
}

offlineCourier($courier_id);
setEndWorkShift($courier_id);
header('Location: couriers.php');