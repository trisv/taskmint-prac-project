<?php
session_start(); 
require 'header.php'; 
require 'functions.php';
?>


<div class="main">
  <div class="signup-form-container">
      <form action="process_signup.php" method="post">
        <h2>Sign Up</h2>
        <p>Enter your details below</p>
        <div class="form-row">
          <div class="form-item">
            <label>Username</label>
            <input type="text" name="u_username" autofocus required>
          </div>

          <div class="form-item">
          <label>Email</label>
          <input type="email" name="u_email" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-item">
            <label>Password</label>
            <input type="password" name="u_password" required>
          </div>
        </div>
      <div class="form-row">
        <div class="form-item">
          <input type="submit" name="submit">
        </div>
      </div>
    </form>
    </div>
  </div>

<?php require 'footer.php'; ?>
