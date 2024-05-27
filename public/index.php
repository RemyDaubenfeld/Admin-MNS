<?php

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

session_start(); 

$page = !empty($_GET['page']) ? ($_GET['page']) : 'index';

$path = "../src/pages/$page.php";

$connnectionPages = ['connection', 'forgotten-pwd', 'reset-pwd'];
$layout = in_array($page, $connnectionPages) ? 'layout-disconnected' : 'layout-connected' ;

if(file_exists($path)) {   
    require '../src/data/db-connect.php';
    require '../src/data/user.php';
    require $path;
    require "../templates/$layout.html.php";
}
else {
    header('HTTP/1.1 404 Not Found');
    require '../templates/404.html.php';
}

