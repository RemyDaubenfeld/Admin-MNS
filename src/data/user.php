<?php
setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');


if (isset($_SESSION['user_id'])) {
    $query = $dbh->prepare("SELECT * FROM user JOIN status ON user.status_id = status.status_id WHERE user_id = :user_id");
    $query->execute(['user_id' => $_SESSION['user_id']]);
    $user = $query->fetch();
}

