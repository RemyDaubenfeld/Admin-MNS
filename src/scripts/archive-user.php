<?php

if (empty($value)) {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Aucun utilisateur renseigné.', 'start' => time()];
    exit;
}

$query = $dbh->prepare('UPDATE user set user_active = false WHERE user_id = :user_id');
$query->execute(['user_id' => $value]);
if($query) {
    if ($value == $_SESSION['user_id']) {
        header("Location: /scripts?script=disconnection");
        exit;
    }

    $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "L'utilisateur a été supprimé avec succès.", 'start' => time()];
    header("Location: /?page=directory");
    exit;
} else {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la suppression de l'utilisateur.", 'start' => time()];
}
