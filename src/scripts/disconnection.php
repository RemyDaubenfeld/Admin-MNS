<?php

if (empty($_SESSION['user_id'])) {
    echo json_encode('Vous devez être connecté.');
    exit;
}

session_destroy();
header('Location: /');