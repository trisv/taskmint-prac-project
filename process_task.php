<?php 

//start session
session_start();
require 'functions.php';
//require the db.php file
require 'db.php';
// // turned global off as not needed (i think)
// global $pdo
//require the task class
require './classes/task.class.php';

if(!userLoggedIn()){
    redirect('login.php');
  }

if(isset($_POST['submit'])) {
    //if nothing was posted, send back to signup.php
    die(Header('Location: index.php'));
}

// start class

//set values 

$t = new tasks($pdo);
$t->setTaskName($_POST['task_name']);
$t->setTaskDetails($_POST['task_details']);
$t->setTaskDateAdded(time());

$create = $t->createTask();

if($create === false){
    die('failed');
}

echo 'create succeeded';
header('location:index.php');

