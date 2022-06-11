<?php
//checks if logged in
function userLoggedIn() {
    if(isset($_SESSION['loggedIn'])) {
        return true;
    }

    return false;
}
//simple die and redirect function
function redirect($url) {
    die(header("Location: {$url}"));
}
//debugger to see output
function m($args){
    echo "<pre style='background:#444;color:#fff;padding:5px;overflow:scroll;'>";
    print_r($args);
    echo "</pre>";
}
//cleans strings from user input
function neutraliseInput($data) {
    $data = strip_tags($data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
