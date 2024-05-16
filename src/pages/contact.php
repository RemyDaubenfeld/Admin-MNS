<?php

$title = 'Contact';

 
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