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

function getMedicine() {
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `medicine`.`medicine_id`, `medicine`.`medicine_name`, `medicine`.`medicine_price`,
        `medicine`.`medicine_pack`, `medicine`.`medicine_dosage`, `medicine`.`medicine_country`,
        `medicine`.`medicine_description`, `medicine`.`medicine_is_recipe` ,
        `medicine_categories`.`medicine_category_name` AS `medicine_category`, `medicine_forms`.`medicine_form_name` AS `medicine_form`
        FROM `medicine`
        INNER JOIN `medicine_categories` ON `medicine`.`medicine_category` = `medicine_categories`.`medicine_category_id`
        INNER JOIN `medicine_forms` ON `medicine`.`medicine_form` = `medicine_forms`.`medicine_form_id`"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function addImageAndPdfInMedicine($array) { // добавляем img и pdf к карточке медицины
    foreach ($array as $row) {
        $row->medicine_img = "../user_app/img/" . $row->medicine_id . ".jpg";
        if ( file_exists("../user_app/pdf/" . $row->medicine_id . ".pdf")) {
            $row->medicine_pdf = "../user_app/pdf/" . $row->medicine_id . ".pdf";
        }
        else $row->medicine_pdf = "";
    }
    return $array;
}

function getUsers() {
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `users`.`user_id`, `users`.`user_phone`, `users`.`user_name`, `users`.`user_address`, `users`.`med_card_number`
        FROM `users`"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}
