<?php
require '../db/config.php';

if ( empty($_GET['order_id']) ) { // check GET data
    die(http_response_code(404));
}
else {
    $order_id = $_GET['order_id'];
}

function isExistOrder($order_id) // проверка существования user_id в БД
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT * FROM `orders` WHERE order_id = '$order_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getOrderContent($order_id) { // берем данные заказов из БД по user_id
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

function addImageInMedicine($array) { // добавляем картинку к карточкам медецины
    foreach ($array as $row) {
        $row->medicine_img = "img/" . $row->medicine_id . ".jpg";
    }
    return $array;
}

if (isExistOrder($order_id)) { // если пользователь есть, то отправляем клиенту

    $order_content = addImageInMedicine( getOrderContent($order_id));

    foreach ($order_content as $row) {
        $total += $row->sum;
    }

    $response = array(
        "result" =>$order_content,
        "total" => round($total,2)
    );

    print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
else {
    die(http_response_code(404));
}
