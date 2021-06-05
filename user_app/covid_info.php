<?php

$content = @file_get_contents("https://corona.lmao.ninja/v3/covid-19/countries/belarus");

if ($content === FALSE) {
    $response = array(
        "cases" =>"upd...",
        "recovered" =>"upd...",
        "deaths" =>"upd..."
    );

    print_r(json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ));
}
else {
    print_r(file_get_contents("https://corona.lmao.ninja/v3/covid-19/countries/belarus"));
}