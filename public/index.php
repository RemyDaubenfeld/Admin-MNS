<?php

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

session_start(); 

$page = !empty($_GET['page']) ? ($_GET['page']) : 'index';

$path = "../src/pages/$page.php";

$offlinePages = ['connection', 'forgotten-pwd', 'reset-pwd'];
$layout = in_array($page, $offlinePages) ? 'layout-disconnected' : 'layout-connected' ;

if(file_exists($path)) {
    require '../src/data/db-connect.php';

    if(!empty($_SESSION['user_id'])) {
        if (in_array($page, $offlinePages)) {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Vous ne pouvez pas accèder à cette page en étant connecté.", 'start' => time()];
            header('Location: /');
            exit;
        }

        require '../src/data/user.php';
        $parentPage = $page == 'account' && $_GET['user-id'] != $userId ? 'directory' : null;

        if (!$userPageAccess) {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Vous n'avez pas accès à cette page.", 'start' => time()];
            header('Location: /');
            exit;
        }
    } else {
        if (!in_array($page, $offlinePages) && empty($_SESSION['user_id'])) {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Vous ne pouvez pas accèder à cette page sans être connecté.", 'start' => time()];
            header('Location: /?page=connection');
            exit;
        }

    }
    require $path;
    require "../templates/$layout.html.php";
} else {
    header('HTTP/1.1 404 Not Found');
    require '../templates/404.html.php';
    exit;
}