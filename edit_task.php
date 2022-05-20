<?php 
session_start();
//require all the necessary files - db for connection, functions for functions and task class
require 'db.php';
require 'functions.php';
require './classes/task.class.php';

//check if logged in, otherwise go away
if(!userLoggedIn()){
    redirect('login.php');
  }
//check if task id is set and not empty 
if(!isset($_GET['task_id']) || empty($_GET['task_id'])){
    redirect('index.php');

  }

//bring in the header
require 'header.php'; 
?>

<div class="task-form-container">
      <form class="task-form" action="process_edit_task.php" method='POST' style="display:flex;width:300px;">
        <h3>Edit Tasks</h3>
        <input type="hidden" name="task_id" value="<?php echo $_GET['task_id']; ?>">
        <?php

        $display_info_for_update = new tasks($pdo);
        $display_info_for_update->setU_ID($_SESSION['u_id']);
        $display_info_for_update->setTaskID($_GET['task_id']);
        $view_edit_info = $display_info_for_update->viewTaskSingle();
        //m($view_edit_info);

        // foreach($view_edit_info as $info_item) {
        //   echo "<strong>Task Name:</strong> " . $info_item['task_name'] . '<br>';
        //   echo "<strong>Task Details:</strong> " . $info_item['task_details'] . "<br>";
        // }
        
        ?>
        <input type="text" name="task_name" value="<?php echo $view_edit_info['task_name'] ?>" required autofocus >
        <input type="text" name="task_details" value="<?php echo $view_edit_info['task_details'] ?>" required >
        <input type="submit" style="cursor:pointer;">
      </form>
    </div>