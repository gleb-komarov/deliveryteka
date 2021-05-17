<?php
require '../db/config.php';

if ( isset($_GET['query']) && isset($_GET['page']) && isset($_GET['per_page'])) { // check GET data
    $query = $_GET['query'];
    $page = $_GET['page'];
    $per_page = $_GET['per_page'];
}
else {
    die(http_response_code(404));
}

if ($query == "all") {
    $array = getMedicine($page, $per_page);
}
else {
    $array = searchMedicine($query, $page, $per_page);
}

function getMedicine($page, $per_page){ // берем всю медицину
    $min = $page * $per_page;
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `medicine`.`medicine_id`, `medicine`.`medicine_name`, `medicine`.`medicine_price`, `medicine`.`medicine_pack`, `medicine`.`medicine_dosage`, `medicine`.`medicine_country`, `medicine`.`medicine_description`, `medicine_categories`.`medicine_category_name` AS `medicine_category`, `medicine_forms`.`medicine_form_name` AS `medicine_form`
        FROM `medicine`
        INNER JOIN `medicine_categories` ON `medicine`.`medicine_category` = `medicine_categories`.`medicine_category_id`
        INNER JOIN `medicine_forms` ON `medicine`.`medicine_form` = `medicine_forms`.`medicine_form_id`
        WHERE `medicine`.`medicine_is_recipe` = 0
        LIMIT $min, $per_page;"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function searchMedicine($query, $page, $per_page){ // ещем медикамент по query
    $min = $page * $per_page;
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `medicine`.`medicine_id`, `medicine`.`medicine_name`, `medicine`.`medicine_price`, `medicine`.`medicine_pack`, `medicine`.`medicine_dosage`, `medicine`.`medicine_country`, `medicine`.`medicine_description`, `medicine_categories`.`medicine_category_name` AS `medicine_category`, `medicine_forms`.`medicine_form_name` AS `medicine_form`
        FROM `medicine`
        INNER JOIN `medicine_categories` ON `medicine`.`medicine_category` = `medicine_categories`.`medicine_category_id`
        INNER JOIN `medicine_forms` ON `medicine`.`medicine_form` = `medicine_forms`.`medicine_form_id`
        WHERE `medicine`.`medicine_name` LIKE '%$query%' AND `medicine`.`medicine_is_recipe` = 0
        LIMIT $min, $per_page;"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function addImageAndPdfInMedicine($array) { // добавляем img и pdf к карточке медицины
    foreach ($array as $row) {
        $row->medicine_img = "img/" . $row->medicine_id . ".jpg";
        if ( file_exists("pdf/" . $row->medicine_id . ".pdf")) {
            $row->medicine_pdf = "pdf/" . $row->medicine_id . ".pdf";
        }
        else $row->medicine_pdf = "";
    }
    return $array;
}

$array = addImageAndPdfInMedicine($array);

$response = array(
    "result" =>$array
);

print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ));
