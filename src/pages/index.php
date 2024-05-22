<?php

if (empty($_SESSION['user_id'])) {
    header('Location: /?page=connection');
    exit;
}

$title = 'Tableau de bord';
