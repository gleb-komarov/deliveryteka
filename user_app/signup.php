<?php
require '../db/config.php';

$err_arr = [
    "0" => [
        "user_id" => "",
        "user_phone" => "",
    ],
];

function isUniquePhone($phone) { // проверка уникальности телефона
    $sql = "SELECT count(*) FROM `users` WHERE user_phone = '$phone'"; // проверка на количество совпадений
    $result = getPdo()->prepare($sql); // выполнение sql запроса
    $result->execute(['phone' => $phone]); // приравнивание ссылки
    return (bool)$result->fetchColumn(); // вывод в виде boolean
}

function returnUserIdbyPhone($phone) {
    $pdo = getPdo();
    $query = $pdo->query("SELECT `user_id`, `user_phone` FROM `users` WHERE `user_phone` = '$phone';");
    return $query->fetchAll(PDO::FETCH_ASSOC); 
}
    $errors = [];

    $postData = file_get_contents('php://input'); // принимаем json-массив из POST
    $data = json_decode($postData, true); // decode json-массива

    $phone = $data["phone"];
    $password = $data["password"];

    if (!$phone) { // если нету переменной телефона
        $errors[] = "enter_phone";
    } else if (isUniquePhone($phone)) { // проверка на уикальность телефона
        $errors[] = "this_phone_already_registred";
    }

    if (!$password) { // если нету переменной пароля
        $errors[] = "enter_password";
    }

if (empty($errors)) {
    $pass_hash = password_hash($password, PASSWORD_DEFAULT);
    $pdo = getPdo(); // подключаемся к БД
    $query = $pdo->query("INSERT INTO  `users` (`user_id` ,`user_phone` ,`user_password`, `user_name`, `user_address`, `med_card_number`) 
                            VALUES (NULL , '$phone', '$pass_hash', NULL, NULL, NULL);"); // запрос

    $array = returnUserIdbyPhone($phone); // возвращаем клиенту информацию о только зарег пользователя через телефон

    if (!$array) { // вдруг его мы все-таки не нашли :D
        print_r(json_encode($err_arr, JSON_UNESCAPED_UNICODE));
        exit;
    }
    else {
        print_r(json_encode($array, JSON_UNESCAPED_UNICODE));
    }
}
else {
    print_r(json_encode($err_arr, JSON_UNESCAPED_UNICODE));
}
?>