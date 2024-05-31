<?php

    $hostname = "localhost";
    $database = "todo";
    $username = "postgres";
    $password = "****";

    try {
        $pdo = new PDO("pgsql:host=$hostname;port=5432;dbname=$database", $username, $password);
    } catch (PDOException $e) {
        echo "ERRO: " . $e->getMessage();
    }
