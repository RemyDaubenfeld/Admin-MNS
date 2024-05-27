<?php

session_start(); 

$script = !empty($_GET['script']) ? $_GET['script'] : '';

$path = "../src/scripts/$script.php";
if(file_exists($path)){
    require '../src/data/db-connect.php';
    require $path;
} else {
    header('Location: /');
    exit;
}