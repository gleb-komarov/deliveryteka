<?php
require '../db/config.php';

$err_arr = [
    "0" => [
        "user_id" => "",
        "user_password" => "",
        "new_password" => "",
    ],
];

if ( empty($_GET['user_id']) || empty($_GET['user_password']) || empty($_GET['new_password'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
    $user_password = $_GET['user_password'];
    $new_password = $_GET['new_password'];
}

function isExistUser($user_id) // проверка существования user_id
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT `users`.`user_id`, `users`.`user_name`, `users`.`user_address` FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function checkUserPassword($user_id, $user_password) {
    $pdo = getPdo(); // подключаемся к бд
    $sql = "SELECT `users`.`user_password` FROM `users` WHERE `users`.`user_id`= '$user_id'";
    $sth = $pdo->prepare($sql); // выполняем запрос
    $sth->execute(['user_id' => $user_id]); // меняем ссылку на переменную
    $user = $sth->fetch(PDO::FETCH_ASSOC); // приравниваем переменую user к результату в виде массива
    if ($user) { // если $user существует
        if (password_verify($user_password, $user['user_password'])) { // и пароль верифицируется, а так же существует $user['password']
            return $user; // возвращаем массив
        }
        else {
            return false;
        }
    }
    else {
        return false; // если нет то возвращаем false
    }
}

function changeUserPassword($user_id, $new_password) {
    $pass_hash = password_hash($new_password, PASSWORD_DEFAULT);
    $pdo = getPdo();
    $query = $pdo->query("UPDATE `users` SET `user_password` = '$pass_hash' WHERE `user_id` = '$user_id';");
}

if (checkUserPassword($user_id, $user_password)) {
    changeUserPassword($user_id, $new_password);

    print_r(json_encode(isExistUser($user_id), JSON_UNESCAPED_UNICODE));
}
else {
    print_r(json_encode($err_arr, JSON_UNESCAPED_UNICODE));
}
