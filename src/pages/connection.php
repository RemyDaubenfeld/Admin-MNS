<?php

if (!empty($_SESSION['user_id'])) {
    header('Location: /');
    exit;
}

$title = 'Connexion';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connect_submit'])) {
    $errors = [];

    if (empty($_POST['user_mail'])) {
        $errors['user_mail']['required_mail'] = ['alert_id' => 'requiredMailAlert', 'message' => 'L\'adresse email est obligatoire.'];
    }

    if (!filter_var($_POST['user_mail'], FILTER_VALIDATE_EMAIL) && !empty($_POST['user_mail'])) {
        $errors['user_mail']['invalid_mail'] = ['alert_id' => 'invalidMailAlert', 'message' => 'Cette adresse email est invalide.'];
    }

    if (empty($_POST['user_password'])) {
        $errors['user_password']['required_password'] = ['alert_id' => 'requiredPasswordAlert', 'message' => 'Le mot de passe est obligatoire.'];
    }

    if(empty($errors)) {
        $email = $_POST['user_mail'];
        $query = $dbh->prepare("SELECT * FROM user INNER JOIN status ON user.status_id = status.status_id WHERE user_mail = :user_mail");
        $query->execute(['user_mail' => $email]);
        $user = $query->fetch();

        if ($user) {
            $salt = "mns";
            $password = $_POST['user_password'] . $salt;

            if (password_verify($password, $user['user_password'])) {
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