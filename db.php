<?php

$host = 'localhost';
$user = 'root';
$password = '';
$dbname='PHPv1';

//set dsn
$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

try {
  //create new pdo instance
  $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
  if($pdo) {
    echo "connection successful";
  }
} catch (PDOException $e) {
	echo $e->getMessage();
}
