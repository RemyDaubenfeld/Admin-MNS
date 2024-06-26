<?php

if (empty($_SESSION['user_id'])) {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Vous devez être connecté.', 'start' => time()];
    echo json_encode('Vous devez être connecté.');
    exit;
}

if (empty($value)) {
    echo json_encode('Aucun mail renseigné.');
    exit;
}

if(isset($value)){
    $query = $dbh->prepare("SELECT count(*) AS nb FROM user WHERE LOWER(user_mail) = LOWER(:user_mail);");
    $query->execute(['user_mail' => $value]);
    $user_mail = $query->fetch();

    echo json_encode($user_mail);
    exit;
}