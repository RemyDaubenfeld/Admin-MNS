<?php

$title = 'Admax - Contact';

if (isset($_SESSION['user_id'])) {
    $query = $dbh->prepare("SELECT * FROM user JOIN status ON user.status_id = status.status_id WHERE user_id = :user_id");
    $query->execute(['user_id' => $_SESSION['user_id']]);
    $user = $query->fetch();
}

 
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact_form_submit']))
{
    $errors = [];

    if (empty($_POST['subject']) || strlen($_POST['subject']) < 1)
    {
        $errors['subject'] = 'Le champs OBJET est obligatoire.';
    }

    if (empty($_POST['message']) || strlen($_POST['message']) < 1)
    {
        $errors['message'] = 'Veuillez entrer votre message.';
    }

    if (empty($errors))
    {   
        // script d'envoi de mail
    }
}