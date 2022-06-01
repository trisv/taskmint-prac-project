<?php 
//require 'db.php';
//could require database class but not necessary as will probably get called somewhere lower on page
?>

<!DOCTYPE html>

<html>
<head>
  <link href="./resources/css/style.css" type="text/css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <div class="header">
  <p>TaskMint</p>  
  <ul class="nav">
    <li><a href="index.php">Home</a></li>
    <li><a href="signup.php">Join</a></li>
  </ul>
  
  
  <?php 
  if(userLoggedIn()) {
  echo "<a class=logout-link href='logout.php'>Logout</a>";
  }
  if(!userLoggedIn()) {
  echo "<a class='login-link' href='login.php'>Login</a>";
  }
  ?>
  
  </div>
