<?php
//start session PRIORITY #1
session_start();
//require database connection
require 'functions.php';
require './classes/database.class.php';
$conn = new Database;


//check if anything is submitted
if(!isset($_POST['submit'])) {
    die(Header('Location: signup.php'));
}

//if something was posted, we then set $_POST variables
$email = neutraliseInput($_POST['u_email']);
$password = neutraliseInput($_POST['u_password']);


//run query to grab user data
$select_u_data = 'SELECT * FROM users WHERE u_email = :email';
$stmt = $conn->getDB()->prepare($select_u_data);
$stmt->bindParam(':email', $email);
$stmt->execute();

$result = $stmt->fetch(PDO::FETCH_ASSOC);

// if no result, redirect to login
if(empty($result)) {
    die(redirect('login.php?1'));
}

// if no match, redirect to login 
if(!password_verify($password, $result['u_password'])) {
    die(redirect('login.php?2'));
}

//if they are indeed who they say they are, set session variable to logged in
$_SESSION['loggedIn'] = true;
$_SESSION['username'] = $result['u_username'];
$_SESSION['u_id'] = $result['u_id'];
redirect('index.php');