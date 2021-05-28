<?php
require '../db/config.php';

$err_arr = [
    "0" => [
        "courier_id" => "",
        "courier_phone" => "",
    ],
];

function loginUser($phone, $password)
{
    if (empty($phone) || empty($password)) { // условие если нету телефона и пароля
        return false; // возвращаем false
    }
    $pdo = getPdo(); // подключаемся к бд
    $sql = "SELECT `courier_phone`, `courier_password` FROM `couriers` WHERE `courier_phone`= '$phone'"; // сравниваем тел с тел в базе
    $sth = $pdo->prepare($sql); // выполняем запрос
    $sth->execute(['courier_phone' => $phone]); // меняем ссылку на переменную
    $user = $sth->fetch(PDO::FETCH_ASSOC); // приравниваем переменую user к результату в виде массива
    if ($user) { // если $user существует
        if (password_verify($password, $user['courier_password'])) { // и пароль верифицируется, а так же существует $user['password']
            return $user; // возвращаем массив
        }
        else return false;
    }
    else {
        return false; // если нет то возвращаем false
    }
}

function returnCourierIdbyPhone($phone) {
    $pdo = getPdo();
    $query = $pdo->query("SELECT `courier_id`, `courier_phone` FROM `couriers` WHERE `courier_phone` = '$phone';");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

$postData = file_get_contents('php://input'); // принимаем json-массив из POST
$data = json_decode($postData, true); // decode json-массива

$phone = $data["phone"];
$password = $data["password"];

$user = loginUser($phone, $password); // переменной user приравниваем переменную

if ($user) { // если user существует
    $array = returnCourierIdbyPhone($phone); // возвращаем клиенту информацию о только автор пользователя через телефон

    if (!$array) { // вдруг его мы все-таки не нашли :D
        print_r(json_encode("404", JSON_UNESCAPED_UNICODE));
        exit;
    }
    else {
        print_r(json_encode($array, JSON_UNESCAPED_UNICODE));
    }
} else {
    print_r(json_encode($err_arr, JSON_UNESCAPED_UNICODE));
}