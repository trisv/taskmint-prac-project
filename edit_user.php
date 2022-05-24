<?php 

session_start();
//require all the necessary files - db for connection, functions for functions and task class
require 'db.php';
require 'functions.php';
require './classes/user.class.php';

//check if logged in, otherwise go away
if(!userLoggedIn()){
    redirect('login.php');
  }


//bring in the header
require 'header.php'; 
?>

<div class="user-form-container">
      <form class="user-form" action="process_edit_user.php" method='POST' style="display:flex;width:300px;">
        <h3>Edit User Details</h3>
        <?php

        $display_user_info_for_update = new users($pdo);
        $display_user_info_for_update->setU_ID($_SESSION['u_id']);
        $view_edit_user_info = $display_user_info_for_update->viewUser();
    
        ?>
        <input type="text" name="u_email" value="<?php echo $view_edit_user_info['u_email'] ?>" autofocus>
        <input type="text" name="u_username" value="<?php echo $view_edit_user_info['u_username'] ?>">
        <input type="password" name="u_password" placeholder="Enter new password">
        <input type="submit" style="cursor:pointer;">
      </form>
    </div>