<?php
session_start();
require 'functions.php';
require './classes/task.class.php';

if(!userLoggedIn()){
  redirect('login.php');
}

 require 'header.php';
 
 ?>

<div class="main">
  <div class="row-1">
    <div class="welcome-bar">
      <?php echo 'Hello ' . "<strong>" . $_SESSION['username'] . "</strong>"; ?>
    </div>
    <div>
      <a class="logout-link"href='logout.php'>Logout</a>
    </div>
  </div>
  <div class="row-2">
    <div class="task-form-container">
      <form class="task-form" action="process_task.php" method='POST'>
        <h3>Add Tasks</h3>
        <input type="text" name="task_name" placeholder="Enter task name" required autofocus >
        <input type="text" name="task_details" placeholder="Enter task details" required >
        <input type="submit" style="cursor:pointer;">
      </form>
    </div>
    <div class="tasks-display-container" style="width:80%;">
      <?php 
      //set new class instance 
      $tasks_list = new tasks($pdo);
      //tell class who user is
        $tasks_list->setU_ID($_SESSION['u_id']);
      //echo tasks viewTasks method to view tasks in database
        $myTasks = $tasks_list->viewTasks();
        ?>

      <div class="task-display">
        <?php
        if(!empty($myTasks)) {
          foreach($myTasks as $task_item) {
            echo "<div class='task-box' style='display:flex;flex-direction:column;width:20%;max-height:175px;background-color:#fff;padding:25px;box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);border-radius:2px;'>";
            //echo "<strong>Task ID:</strong> " . $task_item['task_id'] . "<br>";
            echo "<br>";
            echo "<strong>Task Name:</strong> " . "<br>" . "<a href='task.php?task_id=" . $task_item['task_id'] . "'>" . $task_item['task_name'] . '</a><br>';
            //echo "<strong>Task Details:</strong> " . $task_item['task_details'] . "<br>";
            //echo "<strong>Task Date Added:</strong> " . date("F j, Y, g:i a", $task_item['task_date_added']) . "<br>";
            echo "<a href='process_delete_task.php?task_id=" . $task_item['task_id'] . "' class = 'delete-task-link'>" . "Delete" . "</a>";
            echo "<a href='edit_task.php?task_id=" . $task_item['task_id'] . "' class = 'edit-task-link'>" . "Edit" . "</a>";
            echo "</div>";
          }
        } else {
          echo "no Tasks";
        }
        ?>
      
      </div>
    </div>
  </div> 
</div>


<?php require 'footer.php'; ?>
