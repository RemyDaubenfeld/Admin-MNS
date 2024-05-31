<?php

if (empty($_SESSION['user_id'])) {
    echo json_encode('Vous devez être connecté.');
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);

if ($input && isset($_SESSION['modal_messages'][$input['modal_message_index']])) {
    unset($_SESSION['modal_messages'][$input['modal_message_index']]);
    echo json_encode('Message supprimé en session');
} else {
    echo json_encode('Erreur lors de la suppréssion du message en session.');
}
