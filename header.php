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
    <?php 
    //if user not logged in, display signup nav item
    if(!userLoggedIn()) {
    echo "<li><a href='signup.php'>Join</a></li>";
    }
    ?>
  </ul>
  
  
  <?php 
  //if user is logged in, display logout button, if not logged in then display login button
  if(userLoggedIn()) {
  echo "<a class=logout-link href='logout.php'>Logout</a>";
  } else {
  echo "<a class='login-link' href='login.php'>Login</a>";
  }
  ?>
  
  </div>
