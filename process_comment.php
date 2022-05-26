<?php
session_start();
require 'db.php';
require 'functions.php';
require './classes/comment.class.php';

if(!userLoggedIn()){
    redirect('login.php');
  }

//check if post type is submit
// if(!isset($_POST['submit'])) {
//     //if nothing was posted, send back to index.php
//     die(redirect('index.php'));
// }
//create new comments class instance
$add_comment = new comments($pdo);
//set ids for user, task and comment
$add_comment->setU_ID($_SESSION['u_id']);
$add_comment->setTaskID($_POST['task_id']);
//set variables to add comment elements
$add_comment->setCommentMessage($_POST['comment_message']);
// $add_comment->setCommentDateAdded();
//debuggin'
m($add_comment->getCommentMessage());


$action_add_comment = $add_comment->createComment();

if(!$action_add_comment) {
    echo "Add comment failed";
}

redirect('task.php?task_id='. $add_comment->getTaskID());



