<?php

$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Aucun message à supprimer.', 'start' => time()];
    echo json_encode('Aucun message à supprimer.');
    exit;
}

if ($input && isset($_SESSION['modal_messages'][$input['modal_message_index']])) {
    unset($_SESSION['modal_messages'][$input['modal_message_index']]);
    echo json_encode('Message supprimé en session');
} else {
    echo json_encode('Erreur lors de la suppréssion du message en session.');
}
