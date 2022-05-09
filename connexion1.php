<?php

$username = "username";
$password = "password";

try {
  //$pdo = new PDO('mysql:host=localhost;dbname=gestion_etudiant','root','');
  // set the PDO error mode to exception
  
  $sql = "CREATE DATABASE gestion_etudiant";
  $pdo = new PDO('mysql:host=localhost;dbname=gestion_etudiant','root','');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // use exec() because no results are returned
  $pdo->exec($sql);
  echo "Database created successfully<br>";
} catch(PDOException $e) {
  
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
?>