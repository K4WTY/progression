<?php

    define("DB_NAME", "");
    define("DB_HOST", "");
    define("DB_USER", "");
    define("DB_PASSWORD", "");

    try {
        $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    } catch (PDOException $e) {
        echo $e;
    }

?>
