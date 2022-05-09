<?php

    $host = "localhost";

    $root = "root";
    $root_password = "rootpass";

    $user = 'newuser';
    $pass = 'newpass';
    $db = "gestion_etudiant";

    try {
        $dbh = new PDO("mysql:host=$host", "root","");

        $dbh->exec("CREATE DATABASE `$db`;
                CREATE USER '$user'@'localhost' IDENTIFIED BY '$pass';
                GRANT ALL ON `$db`.* TO '$user'@'localhost';
                FLUSH PRIVILEGES;")
        or die(print_r($dbh->errorInfo(), true));

    }
    catch (PDOException $e) {
        die("DB ERROR: " . $e->getMessage());
    }
?>