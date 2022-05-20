<?php

session_start();
require 'db.php';
require 'functions.php';
require './classes/task.class.php';

//create a class instance 
$task_delete_instance = new tasks($pdo);
//set user id and task id using correct class methods so correct information is selected
$task_delete_instance->setU_ID($_SESSION['u_id']);
$task_delete_instance->setTaskID($_GET['task_id']);
//use delete task class function to action the deleting of the task
$action_delete_task = $task_delete_instance->deleteTask();
//then redirect back to index page
redirect('index.php');


