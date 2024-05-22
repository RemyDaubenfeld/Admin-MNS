<?php

if (!empty($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

$title = 'Mot de passe oublié';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_pwd_submit'])) {
    $errors = [];

    if (empty($_POST['user_mail'])) {
        $errors['user_mail']['invalid_mail'] = ['alert_id' => 'requiredMailAlert', 'message' => 'L\'adresse email est obligatoire.'];
    }

    if (!filter_var($_POST['user_mail'], FILTER_VALIDATE_EMAIL) && !empty($_POST['user_mail'])) {
        $errors['user_mail']['invalid_mail'] = ['alert_id' => 'invalidMailAlert', 'message' => 'Cette adresse email est invalide.'];
    }

    if (empty($errors)) {
        $email = $_POST['user_mail'];
        $query = $dbh->prepare("SELECT * FROM user WHERE user_mail = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch();

        if ($user) {
            // ICI ON DEVRA ENVOYER UN MAIL ET REDIRIGER VERS L'ACCUEIL AVEC UNE MODALE POUR DIRE QU'UN MAIL A ETE ENVOYE (PAS BESOIN DE STOQUER L'EMAIL EN SESSION)
            $_SESSION['user_mail'] = $user['user_mail'];
            header('Location: /?page=reset-pwd');
            exit;
        } else {
            // ICI ON DEVRA STOQUER EN SESSION POUR MODALE
            $errors['user_mail']['incorrect_mail'] = "L'email est incorrect.";
        }
    }
}