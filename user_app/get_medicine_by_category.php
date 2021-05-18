<?php
require '../db/config.php';

if ( isset($_GET['user_id']) && isset($_GET['query']) && isset($_GET['page']) && isset($_GET['per_page'])) { // check GET data
    $user_id = $_GET['user_id'];
    $query = $_GET['query'];
    $page = $_GET['page'];
    $per_page = $_GET['per_page'];
}
else {
    die(http_response_code(404));
}

if (isExistUser($user_id)) {
    if ($query == "По рецепту врача") {
        $array = getMedicineByRecipe($user_id, $page, $per_page);
    }
    else {
        $array = getMedicineByCategory($query, $page, $per_page);
    }
}
else {
    die(http_response_code(404));
}


function isExistUser($user_id) // проверка существования user_id
{
    $pdo = getPdo();
    $query = $pdo->query("SELECT `users`.`user_id`, `users`.`user_name`, `users`.`user_address` FROM `users` WHERE user_id = '$user_id';"); // выполнение sql запроса
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getMedicineByRecipe($user_id, $page, $per_page){
    $min = $page * $per_page;
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `medicine`.`medicine_id`, `medicine`.`medicine_name`, `medicine`.`medicine_price`, `medicine`.`medicine_pack`, `medicine`.`medicine_dosage`,
        `medicine`.`medicine_country`, `medicine`.`medicine_description`, `medicine_categories`.`medicine_category_name` AS `medicine_category`,
        `medicine_forms`.`medicine_form_name` AS `medicine_form`, `med_cards`.`count`
        FROM `med_cards`
        INNER JOIN `medicine` ON `medicine`.`medicine_id` = `med_cards`.`medicine_id`
        INNER JOIN `medicine_categories` ON `medicine`.`medicine_category` = `medicine_categories`.`medicine_category_id`
        INNER JOIN `medicine_forms` ON `medicine`.`medicine_form` = `medicine_forms`.`medicine_form_id`
        WHERE `med_cards`.`user_id` = '$user_id'
        LIMIT $min, $per_page;"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function getMedicineByCategory($query, $page, $per_page){
    $min = $page * $per_page;
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `medicine`.`medicine_id`, `medicine`.`medicine_name`, `medicine`.`medicine_price`, `medicine`.`medicine_pack`, `medicine`.`medicine_dosage`,
        `medicine`.`medicine_country`, `medicine`.`medicine_description`, `medicine_categories`.`medicine_category_name` AS `medicine_category`,
        `medicine_forms`.`medicine_form_name` AS `medicine_form`
        FROM `medicine`
        INNER JOIN `medicine_categories` ON `medicine`.`medicine_category` = `medicine_categories`.`medicine_category_id`
        INNER JOIN `medicine_forms` ON `medicine`.`medicine_form` = `medicine_forms`.`medicine_form_id`
        WHERE `medicine_categories`.`medicine_category_name` = '$query' AND `medicine`.`medicine_is_recipe` = 0
        LIMIT $min, $per_page;"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

function addImageAndPdfInMedicine($array) {
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
