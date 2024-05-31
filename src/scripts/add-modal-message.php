<?php

if (empty($_SESSION['user_id'])) {
    echo json_encode('Vous devez être connecté.');
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if ($input) {
    $_SESSION['modal_messages'][] = ['type' => $input['type'], 'message' => $input['message'], 'start' => time()];
    echo json_encode(['message' =>'Message ajouté en session', 'result' => $_SESSION['modal_messages']]);
} else {
    echo json_encode('Erreur lors de l\'enregistrement du message en session.');
}