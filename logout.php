<?php
//start session
session_start();
//require functions so things won't break
require 'functions.php';
//unset the session variable loggedIn
unset($_SESSION['loggedIn']);
//destroy the session
session_destroy();
//then redirect to login
redirect('login.php');