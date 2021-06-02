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

function removeMedicine($courier_id) {
    $pdo = getPdo(); // подключаемся к БД
    $query = $pdo->query("DELETE FROM `couriers` WHERE `courier_id` = '$courier_id';
    ");
}

removeMedicine($courier_id);
header('Location: couriers.php');