<?php 
session_start();
//require all the necessary files - db for connection, functions for functions and task class
require 'functions.php';
require './classes/database.class.php';
require './classes/task.class.php';

$conn = new Database;

//check if logged in, otherwise redirect to login
if(!userLoggedIn()){
    redirect('login.php');
  }

//check if task id is set and not empty 
if(!isset($_GET['task_id']) || empty($_GET['task_id'])){
    redirect('index.php');

  }

//require the header
require 'header.php'; 
?>
<div class="main">
<div class="edit-task-form-container">
      <form class="task-form" action="process_edit_task.php" method='POST'>
        <h3>Edit Tasks</h3>
        <input type="hidden" name="task_id" value="<?php echo $_GET['task_id']; ?>">
        <?php

        $display_info_for_update = new tasks($conn->getDB());
        $display_info_for_update->setU_ID($_SESSION['u_id']);
        $display_info_for_update->setTaskID($_GET['task_id']);
        $view_edit_info = $display_info_for_update->viewTaskSingle();
        
        
        ?>
        <input type="text" name="task_name" value="<?php echo $view_edit_info['task_name'] ?>" required autofocus >
        <input type="text" name="task_details" value="<?php echo $view_edit_info['task_details'] ?>" required >
        <input type="submit" style="cursor:pointer;">
      </form>
    </div>
</div>