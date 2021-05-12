<?php
require '../db/config.php';

if ( empty($_GET['user_id']) && empty($_GET['medicine_id'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
    $medicine_id = $_GET['medicine_id'];
}

function isExistFavorit($user_id, $medicine_id){ // проверка существования favorit
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `favorites` WHERE user_id = '$user_id' AND medicine_id = '$medicine_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function removeFavorit($user_id, $medicine_id){
    $pdo = getPdo();
    $query = $pdo->query("DELETE FROM `favorites` WHERE user_id = '$user_id' AND medicine_id = '$medicine_id';"); // выполнение sql запроса
}

function getMeidcineById($medicine_id) {
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `medicine`.`medicine_id`, `medicine`.`medicine_name`, `medicine`.`medicine_price`, `medicine`.`medicine_pack`, `medicine`.`medicine_dosage`, `medicine`.`medicine_country`, `medicine`.`medicine_description`, `medicine_categories`.`medicine_category_name` AS `medicine_category`, `medicine_forms`.`medicine_form_name` AS `medicine_form`
        FROM `medicine`
        INNER JOIN `medicine_categories` ON `medicine`.`medicine_category` = `medicine_categories`.`medicine_category_id`
        INNER JOIN `medicine_forms` ON `medicine`.`medicine_form` = `medicine_forms`.`medicine_form_id`
        WHERE `medicine`.`medicine_id` = '$medicine_id';"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

if (isExistFavorit($user_id, $medicine_id)) { // проверяем если favorit существует
    removeFavorit($user_id, $medicine_id); // удаляем user favorit

    $array = getMeidcineById($medicine_id); // возвращаем клиенту медицину которая только что была удалена

    $response = array(
        "result" =>$array
    );

    print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ));
}
else {
    die(http_response_code(404));
}
