<?php
session_start();
//require necessary files
require 'functions.php';
//check if user logged in
if(userLoggedIn()){
  redirect('index.php');
}
//require header
 require 'header.php';
 ?>
</div>
<div class="main">
  <div class="row d-flex">
  <div class="login-form-container">
      <form action="process_login.php" method="post">
        <h2>Login</h2>
        <p>Enter your details below to login</p>
        <div class="form-row">
          <div class="form-item">
          <label>Email</label>
          <input type="email" name="u_email" required autofocus>
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
</div>

<?php include 'footer.php'; ?>

