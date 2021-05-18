<?php
require '../db/config.php';

$err_arr = [
    "0" => [
        "user_id" => "",
        "user_phone" => "",
    ],
];

function loginUser($phone, $password)
{
    if (empty($phone) || empty($password)) { // условие если нету телефона и пароля
        return false; // возвращаем false
    }
    $pdo = getPdo(); // подключаемся к бд
    $sql = "SELECT `user_phone`, `user_password` FROM users WHERE `user_phone`= '$phone'"; // сравниваем тел с тел в базе
    $sth = $pdo->prepare($sql); // выполняем запрос
    $sth->execute(['user_phone' => $phone]); // меняем ссылку на переменную
    $user = $sth->fetch(PDO::FETCH_ASSOC); // приравниваем переменую user к результату в виде массива
    if ($user) { // если $user существует
        if (password_verify($password, $user['user_password'])) { // и пароль верифицируется, а так же существует $user['password']
            return $user; // возвращаем массив
        }
        else return false;
    }
    else {
        return false; // если нет то возвращаем false
    }
}

function returnUserIdbyPhone($phone) {
    $pdo = getPdo();
    $query = $pdo->query("SELECT `user_id`, `user_phone` FROM `users` WHERE `user_phone` = '$phone';");
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

$postData = file_get_contents('php://input'); // принимаем json-массив из POST
$data = json_decode($postData, true); // decode json-массива

$phone = $data["phone"];
$password = $data["password"];

$user = loginUser($phone, $password); // переменной user приравниваем переменную

if ($user) { // если user существует
    $array = returnUserIdbyPhone($phone); // возвращаем клиенту информацию о только автор пользователя через телефон

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