<?php

if (empty($_SESSION['user_id'])) {
    header('Location: /?page=connection');
    exit;
}

// var_dump($_POST);
// exit;

$title = 'Contact';

$query = $dbh->query("SELECT * FROM category WHERE category_active = 1");
$categories = $query->fetchAll();

$categoriesNames = [];
foreach ($categories as $category) {
    $categoriesNames[] = $category['category_name'];
}
 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact_form_hidden_submit'])) {
    $errors = [];

    if (empty($_POST['contact_category'])) {
        $errors['contact_category']['required_category'] = ['alert_id' => 'requiredCategoryAlert', 'message' => 'Veuillez choisir une catégorie.'];
    }

    if (!empty($_POST['contact_category']) && !in_array($_POST['contact_category'], $categoriesNames)) {
        $errors['contact_category']['unknown_category'] = ['alert_id' => 'unknownCategoryAlert', 'message' => 'Catégorie inconnue.'];
    }

    if (empty($_POST['contact_object'])) {
        $errors['contact_object']['required_object'] = ['alert_id' => 'requiredObjectAlert', 'message' => 'L\'objet est obligatoire.'];
    }

    if (strlen($_POST['contact_object']) > 255) {
        $errors['contact_object']['too_long_object'] = ['alert_id' => 'tooLongObjectAlert', 'message' => 'L\'objet ne peux pas dépasser 255 caractères (il comporte actuelement '.strlen($_POST['contact_object']).' caractères).'];
    }

    if (empty($_POST['contact_body'])) {
        $errors['contact_body']['required_body'] = ['alert_id' => 'requiredBodyAlert', 'message' => 'Vous ne pouvez pas envoyer un message vide.'];
    }

    if (empty($errors))
    {   
        // script d'envoi de mail
    }
}