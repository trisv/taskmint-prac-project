<?php session_start();
//require all the necessary files - db for connection, functions for functions and task class
require 'functions.php';
require './classes/database.class.php';
require './classes/task.class.php';
//create database connection
$conn = new Database;

//check if logged in
if(!userLoggedIn()){
    redirect('login.php');
  }

//check if post type is submit
if(isset($_POST['submit'])) {
    //if nothing was posted, send back to signup.php
    die(Header('Location: index.php'));
}

//create new class instance
$task_edit_instance = new tasks($conn->getDB());
//set user and task ids
$task_edit_instance->setU_ID($_SESSION['u_id']);
$task_edit_instance->setTaskID($_POST['task_id']);
//set POST variables 
$task_edit_instance->setTaskName(neutraliseInput($_POST['task_name']));
$task_edit_instance->setTaskDetails(neutraliseInput($_POST['task_details']));

//create variable to edit task
$action_edit_task = $task_edit_instance->editTask();
if(!$action_edit_task) {
  echo "Edit failed";
  //in professional setting, would redirect back to index.php if failed
  //redirect('index.php');
}
//if successful, redirect
redirect('index.php');