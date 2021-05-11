<?php
define('PDO_DSN', 'mysql:host=localhost;dbname=deliverytekadb');
define('PDO_USER', 'root');
define('PDO_PASS', 'root');

function getPdo() {
    static $pdo;
    try {
        if ($pdo === null) {
            $pdo = new PDO(PDO_DSN, PDO_USER, PDO_PASS);
        }
        return $pdo;
    }
    catch (PDOException $e) {
        die("Error connection: " . $e->getMessage());
    }
}