<?php
require '../db/config.php';

function getMedicineCategories() { // берем данные категорий из БД
    $pdo = getPdo();
    $query = $pdo->query(
        "SELECT `medicine_categories`.`medicine_category_name` AS `category`
        FROM `medicine_categories`
        ORDER BY `medicine_categories`.`medicine_category_name`;"
    );
    return $query->fetchAll(PDO::FETCH_OBJ);
}

$categories = getMedicineCategories(); // закидываем все категории в переменную

$array = array ( // создаём элемент массива, "по рецепту врача"
    "category" => "По рецепту врача"
);

array_unshift($categories,$array); // задкидываем по рецепту врача в начала основного массива

$response = array( // пакуем для отправки на клиент
    "result" =>$categories
);

print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
