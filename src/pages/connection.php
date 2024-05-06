<?php

$title = 'Admax - Connection';

var_dump($user);

if (isset($_SESSION['reset_pwd_success'])) {   
    $reset_pwd_success = $_SESSION['reset_pwd_success'];
    unset($_SESSION['reset_pwd_success']);
    unset($_SESSION['user_mail']);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connect_submit'])) {
    $errors = [];

    if (empty($_POST['user_mail']) || !filter_var($_POST['user_mail'], FILTER_VALIDATE_EMAIL)) {
        $errors['user_mail'] = "L'adresse email est obligatoire et doit être une adresse email valide.";
    }

    if (empty($_POST['user_password'])) {
        $errors['user_password'] = "Le mot de passe est obligatoire.";
    }

    if(empty($errors)) {

        $email = $_POST['user_mail'];
        $query = $dbh->prepare("SELECT * FROM user WHERE user_mail = :email");
        $query->execute(['email' => $email]);
        $user = $query->fetch();

        if ($user) {
            $salt = "mns";
            $password = $_POST['user_password'] . $salt;

            if (password_verify($password, $user['user_password'])) {
                session_start();
                $_SESSION['user_id'] = $user['user_id'];

                header('Location: /');
                exit;
            } else {
                $errors['user_mail'] = "L'email ou le mot de passe est incorrect";
                $errors['user_password'] = "L'email ou le mot de passe est incorrect";
            }
        } else {
            $errors['user_mail'] = "L'email ou le mot de passe est incorrect";
            $errors['user_password'] = "L'email ou le mot de passe est incorrect";
        }
    }
}