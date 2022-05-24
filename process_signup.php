<?php

//start session
session_start();

//require database connection
require 'db.php';
require './classes/user.class.php';

//check if anything was posted
if(!isset($_POST['submit'])) {
//if nothing was posted, send back to signup.php
die(Header('Location: signup.php'));
}

$u = new users($pdo);
$u->setEmail($_POST['u_email']);
$u->setUsername($_POST['u_username']);
$u->setPassword($_POST['u_password']);

$create = $u->createUser();

if($create === false) {
  die('failed');
}

echo 'win new user';