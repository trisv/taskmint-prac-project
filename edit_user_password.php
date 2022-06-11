<?php 

session_start();
//require all the necessary files - db for connection, functions for functions and task class
require 'functions.php';
require './classes/database.class.php';
require './classes/user.class.php';
$conn = new Database;

//check if logged in, otherwise go away
if(!userLoggedIn()){
    redirect('login.php');
  }


//bring in the header
require 'header.php'; 
?>

<div class="user-form-container">
    <form class="user-form" action="process_edit_user_pw.php" method='POST' style="display:flex;width:300px;">
        <h3>Edit User Password</h3>
        <input type="password" name="current_password" placeholder="Enter current password" required autofocus>
        <input type="password" name="u_password" placeholder="Enter new password" required>
        <input type="password" name="confirm_password" placeholder="Repeat new password" required>
        <input type="submit" style="cursor:pointer;">
    </form>
</div>