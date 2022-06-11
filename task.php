<?php 
session_start();
require 'functions.php';
require './classes/database.class.php';
require './classes/task.class.php';
require './classes/comment.class.php';
$conn = new Database;

//check if logged in
if(!userLoggedIn()){
    redirect('login.php');
  }
//check if task id is set and not empty 
  if(!isset($_GET['task_id']) || empty($_GET['task_id'])){
    redirect('index.php');

  }

require 'header.php';

$display_task = new tasks($conn->getDB());
//set user id
$display_task->setU_ID($_SESSION['u_id']);
//set task id 
$display_task->setTaskID($_GET['task_id']);


$display_task_info = $display_task->viewTaskSingle();

if(!$display_task_info){

  die(redirect('index.php'));
}




    echo "<div class='task-container-row'>";

    echo "<div class='task-overview-container'>";
    echo "<div class='task-overview-box'>";
    echo "<strong>Task ID:</strong> " . $display_task_info['task_id'] . "<br>";
    echo "<strong>Task Name:</strong> " . $display_task_info['task_name'] . '<br>';
    echo "<strong>Task Details:</strong> " . $display_task_info['task_details'] . "<br>";
    echo "<strong>Task Date Added:</strong> " . date("F j, Y, g:i a", $display_task_info['task_date_added']) . "<br>";
    echo "<a href='edit_task.php?task_id=" . $display_task_info['task_id'] . "' class='edit-task-link'>" . "Edit" . "</a>";        
    echo "<a href='process_delete_task.php?task_id=" . $display_task_info['task_id'] . "' class='delete-task-link'>" . "Delete" . "</a>";
    echo "</div>";
    echo "</div>";
   
// }

?>

<div class="comment-container">
  <div class="comment-box">
    <form class="comment-form" action="process_comment.php" method='POST' style="display:flex;width:300px;">
        <h3>Add Comment</h3>
        <input type="hidden" name="task_id" value="<?php echo $_GET['task_id']; ?>">
        <input type="text" name="comment_message" placeholder="Enter task comment" required autofocus >
        <input type="submit" name="submit" style="cursor:pointer;">
    </form>
  </div>
  <?php 
$display_comment = new comments($conn->getDB());
$display_comment->setU_ID($_SESSION['u_id']);
$display_comment->setTaskID($_GET['task_id']);
$display_comment_info = $display_comment->viewComments();



echo "<div class='display-comment-container'>";
foreach($display_comment_info as $comment_info) {
echo "<div class='display-comment-box'>";
echo "<strong>Comment:</strong>" . $comment_info['comment_message'];
echo "<strong>Date Added:</strong>" . date("d/m/Y H:i:s A",$comment_info['comment_date_added']);
echo "</div>";
}
echo "</div>";
echo "</div>";
echo "</div>";
?>
</div>

<?php include 'footer.php';

