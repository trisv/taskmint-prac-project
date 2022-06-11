<?php 

//start session
session_start();
require 'functions.php';
//require the classes
require './classes/database.class.php';
require './classes/task.class.php';
$conn = new Database;

if(!userLoggedIn()){
    redirect('login.php');
  }

if(isset($_POST['submit'])) {
    //if nothing was posted, send back to signup.php
    die(Header('Location: index.php'));
}

// start class

//set values 

$t = new tasks($conn->getDB());
$t->setTaskName(neutraliseInput($_POST['task_name']));
$t->setTaskDetails(neutraliseInput($_POST['task_details']));
$t->setTaskDateAdded(time());

$create = $t->createTask();

if($create === false){
    die('failed');
}

// echo 'Task successfully created';
redirect('index.php');

