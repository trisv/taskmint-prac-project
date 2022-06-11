<?php

//start session
session_start();

//require database connection
require 'functions.php';
require './classes/database.class.php';
require './classes/user.class.php';
$conn = new Database;



//check if anything was posted
if(!isset($_POST['submit'])) {
//if nothing was posted, send back to signup.php
die(Header('Location: signup.php'));
}


//create new user class
$u = new users($conn->getDB());
$u->setEmail(neutraliseInput($_POST['u_email']));
$u->setUsername(neutraliseInput($_POST['u_username']));
$u->setPassword(neutraliseInput($_POST['u_password']));

//create new user 
$create = $u->createUser();

//if create fails, then notify user and kill connection
if($create === false) {
  die('failed');
}

//if succesful, redirect
redirect('login.php');