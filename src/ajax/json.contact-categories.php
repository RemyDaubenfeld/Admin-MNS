<?php

if (empty($_SESSION['user_id'])) {
    echo json_encode('Vous devez être connecté.');
    exit;
}

$query = $dbh->query("SELECT * FROM category WHERE category_active = 1");
$categories = $query->fetchAll();

$categoriesNames = [];
foreach ($categories as $category) {
    $categoriesNames[] = $category['category_name'];
}

echo json_encode($categoriesNames);
exit;