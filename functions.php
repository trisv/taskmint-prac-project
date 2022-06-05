<?php

function userLoggedIn() {
    if(isset($_SESSION['loggedIn'])) {
        return true;
    }

    return false;
}

function redirect($url) {
    die(header("Location: {$url}"));
}

function m($args){
    echo "<pre style='background:#444;color:#fff;padding:5px;overflow:scroll;'>";
    print_r($args);
    echo "</pre>";
}

function neutraliseInput($data) {
    $data = strip_tags($data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
