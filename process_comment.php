<?php
session_start();
//require necessary files
require 'functions.php';
require './classes/database.class.php';
require './classes/comment.class.php';
//create database connection
$conn = new Database;

//check if user logged in
if(!userLoggedIn()){
    redirect('login.php');
  }

//check if post type is submit
if(!isset($_POST['submit'])) {
    //if nothing was posted, send back to index.php
    die(redirect('index.php'));
}
//create new comments class instance
$add_comment = new comments($conn->getDB());
//set ids for user, task and comment
$add_comment->setU_ID($_SESSION['u_id']);
$add_comment->setTaskID($_POST['task_id']);
//set variables to add comment elements
$add_comment->setCommentMessage(neutraliseInput($_POST['comment_message']));

//create the comment 
$action_add_comment = $add_comment->createComment();

//if no comment added, notify user
if(!$action_add_comment) {
    echo "Add comment failed";
}
//if successful, redirect to task's comment with task-id
redirect('task.php?task_id='. $add_comment->getTaskID());



