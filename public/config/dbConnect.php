<?php

    try {
        $pdo = new PDO("sqlite:../data.db", null, null, [
            PDO::ERRMODE_EXCEPTION => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
        ]);
    } catch (PDOException $e) {
        echo "Error : " . $e->getMessage();
    }