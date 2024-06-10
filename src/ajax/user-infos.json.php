<?php

if (empty($_SESSION['user_id'])) {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Vous devez être connecté.', 'start' => time()];
    echo json_encode('Vous devez être connecté.');
    exit;
}

if (empty($value)) {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Aucun utilisateur renseigné.', 'start' => time()];
    echo json_encode('Aucun utilisateur renseigné.');
    exit;
}

$query = $dbh->prepare("SELECT * FROM user 
                        JOIN status ON user.status_id = status.status_id
                        WHERE user_id = :user_id");
$query->execute(['user_id' => $value]);
$user = $query->fetch();

echo json_encode($user);
exit;