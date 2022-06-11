<?php 

//start session
session_start();
require 'functions.php';

//require the classes
require './classes/database.class.php';
require './classes/task.class.php';
//create new database connection
$conn = new Database;

//check if logged in
if(!userLoggedIn()){
    redirect('login.php');
  }
//check if anything was submitted via POST
if(isset($_POST['submit'])) {
    //if nothing was posted, send back to signup.php
    die(Header('Location: index.php'));
}

//create new tasks class
$t = new tasks($conn->getDB());
//set properties
$t->setTaskName(neutraliseInput($_POST['task_name']));
$t->setTaskDetails(neutraliseInput($_POST['task_details']));
$t->setTaskDateAdded(time());
//create new task
$create = $t->createTask();
//if it failes, notify user and kill connection
if($create === false){
    die('failed');
}

// if successful, redirect 
redirect('index.php');

