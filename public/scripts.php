<?php

session_start(); 

$script = !empty($_GET['script']) ? $_GET['script'] : '';
$value = !empty($_GET['value']) ? urldecode($_GET['value']) : '';

$path = "../src/scripts/$script.php";
if(file_exists($path)){
    require '../src/data/db-connect.php';

    if (empty($_SESSION['user_id'])) {
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Vous devez être connecté.', 'start' => time()];
        header('Location: /');
        exit;
    }

    require $path;
} else {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Script inexistant.', 'start' => time()];
    header('Location: /');
    exit;
}