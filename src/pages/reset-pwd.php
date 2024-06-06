<?php

$query = $dbh->prepare('SELECT user_token, user_token_valid FROM user WHERE user_token = :user_token');
$query->execute(['user_token' => $_POST['token']]);
$token = $query->fetch();

if (!$token) {
    header('Location: /?page=forgotten-pwd');
    exit;
}

if ((strtotime(date("Y-m-d H:i:s")) - strtotime($token['user_token_valid'])) > 3600) {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Votre token a expiré, veuillez réessayer.', 'start' => time()];
    header('Location: /?page=forgotten-pwd');
    exit;
}

$title = 'Réinitialiser mon mot de passe';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_pwd_hidden_submit'])) {
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

        $query = $dbh->prepare('UPDATE user SET user_password = :new_password WHERE user_token = :user_token AND user_active = 0');
        $query->execute([
            'new_password' => password_hash($password, PASSWORD_DEFAULT),
            'user_token' => $token['user_token']
        ]);

        if ($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Votre mot de passe a été mis à jour avec succès.', 'start' => time()];
            header('Location: /');
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Echec de la mise à jour de votre mot de passe. Votre token peut-être a expiré, veuillez réessayer.', 'start' => time()];
            header('Location: /?page=forgotten-pwd');
            exit;
        }
    }
}