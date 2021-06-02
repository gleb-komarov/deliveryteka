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

offlineCourier($courier_id);
header('Location: couriers.php');