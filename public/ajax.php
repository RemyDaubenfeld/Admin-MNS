<?php

session_start(); 

$ajax = !empty($_GET['ajax']) ? $_GET['ajax'] : '';
$value = !empty($_GET['value']) ? urldecode($_GET['value']) : '';

$path = "../src/ajax/json.$ajax.php";
if(file_exists($path)){
    require '../src/data/db-connect.php';
    require $path;
} else {
    echo json_encode("Fichier '$ajax' inexistant.");
    exit;
}