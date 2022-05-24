<?php 
session_start();
require 'functions.php';
require './classes/task.class.php';
//check if logged in
if(!userLoggedIn()){
    redirect('login.php');
  }
//check if task id is set and not empty 
  if(!isset($_GET['task_id']) || empty($_GET['task_id'])){
    redirect('index.php');

  }

require 'header.php';

$display_task = new tasks($pdo);
//set user id
$display_task->setU_ID($_SESSION['u_id']);
//set task id 
$display_task->setTaskID($_GET['task_id']);


$display_task_info = $display_task->viewTaskSingle();

if(!$display_task_info){

  die(redirect('index.php'));
}

//m($display_task_info);

// var_dump($display_task_info = $display_task);

// foreach($display_task_info as $task_info) {
    echo "<div class='task-overview-container'>";
    echo "<div class='task-overview-box'>";
    echo "<strong>Task ID:</strong> " . $display_task_info['task_id'] . "<br>";
    echo "<strong>Task Name:</strong> " . $display_task_info['task_name'] . '<br>';
    echo "<strong>Task Details:</strong> " . $display_task_info['task_details'] . "<br>";
    echo "<strong>Task Date Added:</strong> " . date("F j, Y, g:i a", $display_task_info['task_date_added']) . "<br>";
    echo "<a href='process_edit_task.php?task_id=" . $display_task_info['task_id'] . "' class='edit-task-link'>" . "Edit" . "</a>";        
    echo "<a href='process_delete_task.php?task_id=" . $display_task_info['task_id'] . "' class='delete-task-link'>" . "Delete" . "</a>";
    echo "</div>";
    echo "</div>";
   
// }