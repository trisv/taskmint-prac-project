<?php session_start();
//require all the necessary files - db for connection, functions for functions and task class
//require 'db.php';
require 'functions.php';
require './classes/database.class.php';
require './classes/user.class.php';
$conn = new Database;

if(!userLoggedIn()){
    redirect('login.php');
  }

//check if post type is submit
if(isset($_POST['submit'])) {
    //if nothing was posted, send back to signup.php
    die(redirect('index.php'));
}
//set $_POST variables from form
$current_password = $_POST['current_password'];
$new_password = $_POST['u_password'];
$confirm_password = $_POST['confirm_password'];

//create new users class instance
$user_pw_edit_instance = new users($conn->getDB());
//set relevant variables for class 
$user_pw_edit_instance->setU_ID($_SESSION['u_id']);
$user_pw_edit_instance->setPassword($_POST['u_password']);
//bit of debugging
m($user_pw_edit_instance);
//db query to fetch pw to compare POST password against 
$password_query = 'SELECT u_password FROM users WHERE u_id = :u_id';
$stmt = $pdo->prepare($password_query);
$stmt->bindParam('u_id', $_SESSION['u_id']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
//little more debugging to ensure correct output from query
m($result);
//if no result, tell the user
if(!$result) {
    echo "no result";
}
//if no match with db password, go away
if(!password_verify($current_password, $result['u_password'])){
    die(redirect('edit_user.php?1'));
}
//if no match between new password and confirmation, go away
if($new_password !== $confirm_password) {
    die(redirect('edit_user.php?2'));
}

// //create variable for editing the user
$action_edit_user_pw = $user_pw_edit_instance->editPassword();
if(!$action_edit_user_pw) {
     echo 'edit failed';
 }
//if successful, redirect user to index.php page
redirect('index.php');







