<?php

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Aucun message à ajouter.', 'start' => time()];
    echo json_encode('Aucun message à ajouter.');
    exit;
}

if ($input) {
    $_SESSION['modal_messages'][] = ['type' => $input['type'], 'message' => $input['message'], 'start' => time()];
    echo json_encode(['message' =>'Message ajouté en session', 'result' => $_SESSION['modal_messages']]);
} else {
    echo json_encode('Erreur lors de l\'enregistrement du message en session.');
}