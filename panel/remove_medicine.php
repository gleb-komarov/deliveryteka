<?php
require '../function.php';

session_start();
if ( isset($_SESSION['login'])) { // проверям залогинен ли admin
    $admin_login = $_SESSION['login'];
}
else {
    header('Location: ../login'); // если не залогинен переходим на страницу логина
}

$medicine_id = $_GET['medicine_id'];

function removeMedicine($medicine_id) {
    $pdo = getPdo(); // подключаемся к БД
    $query = $pdo->query("DELETE FROM `medicine` WHERE `medicine_id` = '$medicine_id';
    ");
}

removeMedicine($medicine_id);
header('Location: medicine.php');