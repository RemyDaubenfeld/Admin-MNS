<?php

if (empty($_SESSION['user_id'])) {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Vous devez être connecté.', 'start' => time()];
    echo json_encode('Vous devez être connecté.');
    exit;
}

$query = $dbh->query("SELECT * FROM status WHERE status_active = 1");
$status = $query->fetchAll();

// $statusNames = [];
// foreach ($status as $currentStatus) {
//     $statusNames[] = $currentStatus['category_name'];
// }

echo json_encode($status);
exit;