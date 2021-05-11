<?php
require '../db/config.php';

if ( empty($_GET['user_id']) ) { // check GET data
    die(http_response_code(404));
}
else {
    $user_id = $_GET['user_id'];
}

function getUserById($id){
    $pdo = getPdo();
    $query = $pdo->query("SELECT `user_phone`, `user_name`, `user_adress`, `` FROM `users` WHERE `id` = '$id';");
    return $query->fetchAll(PDO::FETCH_OBJ); 
}

if (getUserById($id)) {
    $array = getUserById($id);
    print_r(json_encode($array, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
}
else {
    echo "404";
}
