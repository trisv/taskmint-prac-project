<?php session_start();
//require all the necessary files - db for connection, functions for functions and task class
require 'db.php';
require 'functions.php';
require './classes/user.class.php';

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
$user_pw_edit_instance = new users($pdo);
//set relevant variables using $_SESSION for user id and $_POST for variables coming from form
$user_pw_edit_instance->setU_ID($_SESSION['u_id']);
$user_pw_edit_instance->setPassword($_POST['u_password']);
m($user_pw_edit_instance);

$password_query = 'SELECT u_password FROM users WHERE u_id = :u_id';
$stmt = $pdo->prepare($password_query);
$stmt->bindParam('u_id', $_SESSION['u_id']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
m($result);
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

redirect('index.php');







