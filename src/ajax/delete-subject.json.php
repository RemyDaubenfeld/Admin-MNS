<?php

header('Content-Type: application/json');

$data = $_GET['value'];

if (isset($data) && is_numeric($data)){
    $query = $dbh->prepare('DELETE FROM subject WHERE subject_id = :subject_id');
    //$query = $dbh->prepare('UPDATE subject set subject_active = false WHERE subject_id = :subject_id');
    $query->execute(['subject_id' => $data]);
    $deleteSubject = $query->fetch();
    if ($deleteSubject) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression.']);
}