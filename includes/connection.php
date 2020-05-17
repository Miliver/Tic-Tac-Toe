<?php
try{
    $mysqli = new mysqli("localhost", "root", "", "tic-tac-toe");
    if ($mysqli->connect_errno) {
        echo("Database connection error");
        exit();
    }
    $mysqli ->set_charset("utf8");
} catch(Exception $e){
    echo("Error from database: " + $e->getMessage());
    exit();
}
?>