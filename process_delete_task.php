<?php

session_start();
//require necessary files
require 'functions.php';
require './classes/database.class.php';
require './classes/task.class.php';
//create new database
$conn = new Database;

//check if logged in, otherwise redirect
if(!userLoggedIn()){
    redirect('login.php');
  }

//create a class instance 
$task_delete_instance = new tasks($conn->getDB());
//set user id and task id using correct class methods so correct information is selected
$task_delete_instance->setU_ID($_SESSION['u_id']);
$task_delete_instance->setTaskID($_GET['task_id']);
//use delete task class function to action the deleting of the task
$action_delete_task = $task_delete_instance->deleteTask();
//then redirect back to index page
redirect('index.php');


