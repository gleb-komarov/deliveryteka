<?php
require '../db/config.php';

if ( empty($_GET['user_id'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
}

function isExistUser($user_id) // проверка существования user_id в БД
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getFavoritesByUserId($user_id) { // берем данные корины из БД по user_id
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `medicine`.`medicine_id`, `medicine`.`medicine_name`, `medicine`.`medicine_price`,
        `medicine`.`medicine_pack`, `medicine`.`medicine_dosage`, `medicine`.`medicine_country`, `medicine`.`medicine_description`,                           `medicine_forms`.`medicine_form_name` AS `medicine_form`
        FROM `favorites`
        INNER JOIN `medicine` ON `medicine`.`medicine_id` = `favorites`.`medicine_id`
        INNER JOIN `medicine_forms` ON `medicine`.`medicine_form` = `medicine_forms`.`medicine_form_id`
        WHERE `favorites`.`user_id` = '$user_id'"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function addImageInMedicineBasket($array) { // добавляем картинку к карточкам медецины
    foreach ($array as $row) {
        $row->img = "img/" . $row->medicine_id . ".jpg";
    }
    return $array;
}

if (isExistUser($user_id)) { // если пользователь есть, то все собириаем и отправляем клиенту

    $basket = addImageInMedicineBasket(getFavoritesByUserId($user_id));

    $response = array(
        "result" =>$basket
    );

    print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
else {
    die(http_response_code(404));
}
