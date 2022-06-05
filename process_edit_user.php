<?php session_start();
//require all the necessary files - db for connection, functions for functions and task class
//require 'db.php';
require 'functions.php';
require './classes/database.class.php';
require './classes/user.class.php';
$conn = new Database;
//check user logged in
if(!userLoggedIn()){
    redirect('login.php');
  }

//check if post type is submit
if(isset($_POST['submit'])) {
    //if nothing was posted, send back to signup.php
    die(Header('Location: index.php'));
}
//create new users class instance
$user_edit_instance = new users($conn->getDB());
//set relevant variables using $_SESSION for user id and $_POST for variables coming from form
$user_edit_instance->setU_ID($_SESSION['u_id']);
$user_edit_instance->setEmail(neutraliseInput($_POST['u_email']));
$user_edit_instance->setUsername(neutraliseInput($_POST['u_username']));
//debugging
m($user_edit_instance);
//create variable for editing the user
$action_edit_user = $user_edit_instance->editUser();
// if there's an issue, tell user
if(!$action_edit_user) {
    echo 'edit failed';
}
//if successful, redirect
$_SESSION['username'] = $_POST['u_username'];
redirect('index.php');