<?php

require '../src/pages/libs/form-control.php';

$query = $dbh->prepare('SELECT user_token, user_token_valid FROM user WHERE user_token = :user_token');
$query->execute(['user_token' => $_POST['token']]);
$token = $query->fetch();

// var_dump($token);
// exit;

if (!$token || (strtotime(date("Y-m-d H:i:s")) - strtotime($token['user_token_valid'])) > 3600) {
    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Impossible d\'accéder à cette page.Votre token peut-être a expiré, veuillez réessayer.', 'start' => time()];
    header('Location: /?page=forgotten-pwd');
    exit;
}

$title = 'Réinitialiser mon mot de passe';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['new_pwd_hidden_submit'])) {
    $errors = 0;

    $passwordData = resetPasswordCheck($_POST['new_password'] ?? null, $_POST['confirm_password'] ?? null);
    $errors += $passwordData['errors'];
    $password = $passwordData['password'];

    if (empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_password = :new_password WHERE user_token = :user_token AND user_active = 0');
        $query->execute([
            'new_password' => password_hash($password, PASSWORD_DEFAULT),
            'user_token' => $token['user_token']
        ]);

        if ($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Votre mot de passe a été mis à jour avec succès.', 'start' => time()];
            header('Location: /?page=connection');
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Echec de la mise à jour de votre mot de passe. Votre token peut-être a expiré, veuillez réessayer.', 'start' => time()];
            header('Location: /?page=forgotten-pwd');
            exit;
        }
    }
}