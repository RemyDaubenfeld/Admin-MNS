<?php

if (!empty($_SESSION['user_id']) || empty($_SESSION['user_mail'])) {
    header('Location: /');
    exit;
}

$title = 'Réinitialiser mon mot de passe';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_pwd_submit'])) {
    $errors = [];

    if(!empty($_POST['new_password'])){
        $password = $_POST['new_password'];

        if(strlen($password) < 8 || strlen($password) > 40){
            $errors['new_password']['length_password'] = ['alert_id' => 'lengthNewPasswordAlert', 'message' => 'Le mot de passe doit comporter entre 8 et 40 caractères.'];
        }

        if(!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-])/', $password)){
            $errors['new_password']['format_password'] = ['alert_id' => 'formatNewPasswordAlert', 'message' => 'Le nouveau mot de passe doit contenir au minimum une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).'];
        }
    } else {
        $errors['new_password']['required_password'] = ['alert_id' => 'requiredNewPasswordAlert', 'message' => 'Le nouveau mot de passe est obligatoire.'];
    }

    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password']['required_password'] = ['alert_id' => 'requiredConfirmPasswordAlert', 'message' => 'La confirmation du mot de passe est obligatoire.'];
    }

    if (($_POST['confirm_password']) != ($_POST['new_password'])){
        $errors['confirm_password']['different_password'] = ['alert_id' => 'differentConfirmPasswordAlert', 'message' => 'Les mots de passe doivent être identique.'];
    }

    if (empty($errors)) {
        $salt = "mns";
        $password = $_POST['new_password'] . $salt;
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = $dbh->prepare('UPDATE user SET user_password = :new_password WHERE user_mail = :email');
        $query->execute([
            'new_password' => $password,
            'email' => $user_mail
        ]);

        if ($query) {
            // ICI ON DEVRA STOQUER EN SESSION POUR MODALE
            $_SESSION['success_modal']['reset_pwd_success'] = 'Votre mot de passe a été mis à jour avec succès !';
            header('Location: /?page=connexion');
            exit;
        }
    }
}