<?php
require '../db/config.php';

if ( empty($_GET['user_id']) && empty($_GET['medicine_id'])) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
    $medicine_id = $_GET['medicine_id'];
}

function isExistUserBasket($user_id, $medicine_id){ // проверка существования user_id
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `basket` WHERE user_id = '$user_id' AND medicine_id = '$medicine_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function removeBasket($user_id, $medicine_id){
    $pdo = getPdo();
    $query = $pdo->query("DELETE FROM `basket` WHERE user_id = '$user_id' AND medicine_id = '$medicine_id';"); // выполнение sql запроса
}


function isExistUser($user_id) // проверка существования user_id в БД
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getBaskeyByUserId($user_id) { // берем данные корины из БД по user_id
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `medicine`.`medicine_id`, `medicine`.`medicine_name`, `medicine`.`medicine_price`, `medicine`.`medicine_pack`,
       `medicine`.`medicine_dosage`, `medicine`.`medicine_country`, `medicine`.`medicine_description`, `medicine`.`medicine_form`, `basket`.`count`, `basket`.`sum`
        FROM `basket`
        INNER JOIN `medicine` ON `medicine`.`medicine_id` = `basket`.`medicine_id`
        WHERE `basket`.`user_id` = '$user_id'"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function addImageInMedicineBasket($array) { // добавляем картинку к карточкам медецины
    foreach ($array as $row) {
        $row->medicine_img = "img/" . $row->medicine_id . ".jpg";
    }
    return $array;
}

if (isExistUserBasket($user_id, $medicine_id)) {// проверяем если user basket существует
    removeBasket($user_id, $medicine_id); // удаляем user basket

    $basket = addImageInMedicineBasket(getBaskeyByUserId($user_id));

    foreach ($basket as $row) {
        $total += $row->sum;
    }

    $response = array(
        "result" =>$basket,
        "total" => round($total,2)
    );

    print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
else {
        die(http_response_code(404));
}
