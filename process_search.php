<?php

//start session
session_start();
//require relevant files
require 'functions.php';
require './classes/database.class.php';
require './classes/user.class.php';
require './classes/task.class.php';

//instatiate database 
$conn = new Database;

//redirect if not logged in
if(!userLoggedIn()){
    redirect('login.php');
  }

//check if anything searched through post
if(!isset($_POST['submit'])) {
    die(redirect('index.php'));
}

//require header
require 'header.php';

//if something searched, process
$user_id = $_SESSION['u_id'];
$search_term = neutraliseInput($_POST['search_term']);
$search_query = 'SELECT * FROM tasks WHERE task_name LIKE :search_term AND u_id = :u_id';
$stmt = $conn->getDB()->prepare($search_query);
$search_term = "%" . $search_term . "%";
$stmt->bindParam(':search_term', $search_term, PDO::PARAM_STR);
$stmt->bindParam(':u_id', $user_id);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo "<div class='task-display-container'>";
echo "<div class='task-display'>";
foreach($results as $result) {
    echo "<div class='task-box'>";
    echo "<strong>Task ID:</strong> " . $result['task_id'] . "<br>";
    echo "<br>";
    echo "<strong>Task Name:</strong> " . "<br>" . "<a href='task.php?task_id=" . $result['task_id'] . "'>" . $result['task_name'] . '</a><br>';
    echo "<strong>Task Details:</strong> " . $result['task_details'] . "<br>";
    echo "<strong>Task Date Added:</strong> " . date("F j, Y, g:i a", $result['task_date_added']) . "<br>";
    echo "</div>";
}
echo "</div>";
echo "</div>";


