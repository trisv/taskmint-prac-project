<?php

//start session
session_start();

//require database connection
require 'db.php';

//check if anything was posted
if(!isset($_POST['submit'])) {
//if nothing was posted, send back to signup.php
die(Header('Location: signup.php'));
}

//if something was posted, we then set set $_POST variables
$email = $_POST['u_email'];
$password = $_POST['u_password'];
$username = $_POST['u_username'];
$hash_pw = password_hash($password, PASSWORD_BCRYPT,['cost' => 12]);
//we then run try/catch statement including PDO statement to insert data in 'users' table
try{
$sql = 'INSERT INTO users(u_email, u_password, u_username) VALUES (:u_email, :u_password, :u_username)';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':u_email', $email);
$stmt->bindParam(':u_password', $hash_pw);
$stmt->bindParam(':u_username', $username);
$stmt->execute();
//die(header('Location: login.php'));
} catch(PDOException $e) {
  //if there is an error in the statement, this will display it
  echo $e->getMessage();
}
