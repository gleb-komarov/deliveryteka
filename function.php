<?php
require 'db/config.php';

function loginUser($login, $password)
{
    if (empty($login) || empty($password)) { // условие если нету логина и пароля
        return false; // возвращаем false
    }
    $pdo = getPdo(); // подключаемся к бд
    $sql = "SELECT `admin_id`, `admin_login`, `admin_password` FROM `admins` WHERE `admin_login`='$login'"; // сравниваем логин с логином в бд
    $sth = $pdo->prepare($sql); // выполняем запрос
    $sth->execute(['admin_login' => $login]); //меняем ссылку на переменную
    $user = $sth->fetch(PDO::FETCH_ASSOC); // приравниваем переменую user к результату в виде массива
    if (!empty($user)) { // если $user существует
//        if (password_verify($password, $user['admin_password'])) { // и пароль верифицируется, а так же существует $user['password']
//            return $user; // возвращаем массив
//        }
        if ( $password == $user['admin_password']) { // и пароль верифицируется, а так же существует $user['password']
            return $user; // возвращаем массив
        }
    }
    return false; // если нет то возвращаем false
}