<?php
//start session
session_start();
//require functions so things won't break
require 'functions.php';
//unset the session variables
unset($_SESSION['loggedIn']);
unset($_SESSION['u_id']);
unset($_SESSION['username']);
//destroy the session
session_destroy();
//then redirect to login
redirect('login.php');