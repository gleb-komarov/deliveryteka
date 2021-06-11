<?php
require 'db/config.php';

function loginUser($login, $password)
{
    if (empty($login) || empty($password)) { // условие если нету логина и пароля
        return false; // возвращаем false
    }
    $pdo = getPdo(); // подключаемся к бд
    $sql = "SELECT `admin_id`, `admin_login`, `admin_password` FROM `admins` WHERE `admin_login`='$login';"; // сравниваем логин с логином в бд
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
        INNER JOIN `medicine_forms` ON `medicine`.`medicine_form` = `medicine_forms`.`medicine_form_id`
        ORDER BY `medicine`.`medicine_id` DESC;"
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
        FROM `users` ORDER BY `users`.`user_id` DESC;");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getCouriers() {
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `couriers`.`courier_id`, `couriers`.`courier_phone`, `couriers`.`courier_name`, `couriers`.`is_online`, `couriers`.`active_order_id`, `couriers`.`all_shifts`, `couriers`.`all_hours`
        FROM `couriers` ORDER BY `couriers`.`courier_id` DESC;");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getOrders() {
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `orders`.`order_id`, `orders`.`order_datetime`, `orders`.`courier_salary`, `order_statuses`.`order_status_name` AS `order_status`, `orders`.`courier_id`,
        `orders`.`user_phone`, `orders`.`user_address`, `orders`.`user_comment`, `pay_methods`.`pay_method_name` AS `pay_method` , `orders`.`order_total`
        FROM `orders`
        INNER JOIN `order_statuses` ON `order_statuses`.`order_status_id` = `orders`.`order_status_id`
        INNER JOIN `pay_methods` ON `pay_methods`.`pay_method_id` = `orders`.`pay_method_id`
        ORDER BY `orders`.`order_datetime` DESC;"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function isUniqueCourierPhone($phone) // проверка уникальности email
{
    $sql = "SELECT count(*) FROM `couriers` WHERE courier_phone = '$phone';"; // проверка на количество совпадений
    $result = getPdo()->prepare($sql); // выполнение sql запроса
    $result->execute(['phone' => $phone]); // приравнивание ссылки
    return (bool)$result->fetchColumn(); // вывод в виде boolean
}

function registerCourier($phone, $password, $name)
{
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    $pdo = getPdo(); // подключаемся к БД
    $query = $pdo->query("INSERT INTO  `couriers` (`courier_id` ,`courier_phone` ,`courier_password`, `courier_name`, `is_online`, `active_order_id`, `all_shifts`, `all_hours`) 
    VALUES (NULL , '$phone', '$pass_hash', '$name', 0, NULL , 0, 0);"); // запрос
}

function getMedicineForms() {
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `medicine_forms`");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getMedicineCategories() {
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `medicine_categories`");
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getOrderContent($order_id) {
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `medicine`.`medicine_id`, `medicine`.`medicine_name`, `medicine`.`medicine_price`, `medicine`.`medicine_pack`,
       `medicine`.`medicine_dosage`, `medicine`.`medicine_country`, `medicine`.`medicine_description`, `order_content`.`count`, `order_content`.`sum`, `medicine_forms`.`medicine_form_name` AS `medicine_form`
        FROM `order_content`
        INNER JOIN `medicine` ON `medicine`.`medicine_id` = `order_content`.`medicine_id`
        INNER JOIN `medicine_forms` ON `medicine`.`medicine_form` = `medicine_forms`.`medicine_form_id`
        WHERE `order_content`.`order_id` = '$order_id'"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getErrors($errors) {
    if (!empty($errors)) {
        echo "<ul class='error__list'>";
        foreach ($errors as $error) {
            echo "<li class='error__item'>$error</li>";
        }
        echo "</ul>";
    }
}
