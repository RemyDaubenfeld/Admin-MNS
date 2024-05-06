<?php

$title = 'Admax - Mot de passe oublié';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_pwd_submit'])) {
    $errors = [];

    if (empty($_POST['user_mail']) || !filter_var($_POST['user_mail'], FILTER_VALIDATE_EMAIL)) {
        $errors['user_mail'] = "L'adresse email est obligatoire et doit être une adresse email valide.";
    }

    if (empty($errors)) {

        $email = $_POST['user_mail'];
        $query = $dbh->prepare("SELECT * FROM user WHERE user_mail = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch();

        if ($user) {   
            $_SESSION['user_mail'] = $user['user_mail'];
            header('Location: /?page=reset_pwd');
            exit;
        } else {
            $errors['user_mail'] = "L'adresse mail n'est reliée à aucun compte existant.";
        }
    }
}