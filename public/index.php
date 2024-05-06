<?php

session_start();

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');


if(!empty($_SESSION['user_id']) || (isset($_GET['page']) && ($_GET['page']) == 'forgotten_pwd') || (isset($_GET['page']) && $_GET['page'] == 'reset_pwd'))
{
    $page = !empty($_GET['page']) ? ($_GET['page']) : 'index';
}
else
{
    $page = 'connection';
}

$path = '../src/pages/' . $page . '.php';

if(file_exists($path))
{   
    require '../src/data/db-connect.php';
    require "../src/pages/$page.php";
    require '../templates/layout.html.php';
}
else
{
    header('HTTP/1.1 404 Not Found');
    require '../templates/404.html.php';
}

