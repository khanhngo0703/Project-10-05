<?php
function dd($args){
    echo '<pre>';
    var_dump($args);
    echo '</pre>';
    // die();
}

function sanitize($args){
    $args = trim($args);
    $args = stripslashes($args);
    $args = htmlspecialchars($args);
    return $args;
}