<?php

$title = 'Admax - Réinitialiser mot de passe';

if (isset($_SESSION['user_mail'])) {   
    $user_mail = $_SESSION['user_mail'];
} else {
    echo 'Erreur lors de la récupération du mot de passe';
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['validate_pwd_submit'])) {
    $errors = [];

    if (empty($_POST['user_password'])) {
        $errors['user_password'] = 'Le mot de passe est obligatoire.';
    }

    if (empty($_POST['new_password'])) {
        $errors['new_password'] = 'La confirmation du mot de passe est obligatoire.';
    }

    if (empty($errors)) {
        if (($_POST['user_password']) === ($_POST['new_password'])) {
            $salt = "mns";
            $password = $_POST['user_password'] . $salt;
            $password = password_hash($password, PASSWORD_DEFAULT);

            //require '../src/data/db-connect.php';
            $query = $dbh->prepare('UPDATE user SET user_password = :user_password WHERE user_mail = :email');
            $query->execute(['user_password' => $password, 'email' => $user_mail]);

            if ($query) {
                $_SESSION['reset_pwd_success'] = 'Votre mot de passe a été mis à jour avec succès !';

                header('Location: /?page=connexion');
                exit;
            }
        } else {   
            $errors['user_password'] = 'Les mots de passe doivent être identique.';
        }
    }
}