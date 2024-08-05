<?php

require '../src/pages/libs/generate-token.php';

$title = 'Mot de passe oublié';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reset_pwd_submit'])) {
    $errors = [];

    if (empty($_POST['user_mail'])) {
        $errors['user_mail']['invalid_mail'] = ['alert_id' => 'requiredMailAlert', 'message' => 'L\'adresse mail est obligatoire.'];
    }

    if (!filter_var($_POST['user_mail'], FILTER_VALIDATE_EMAIL) && !empty($_POST['user_mail'])) {
        $errors['user_mail']['invalid_mail'] = ['alert_id' => 'invalidMailAlert', 'message' => 'Cette adresse mail est invalide.'];
    }

    if (empty($errors)) {
        $mail = $_POST['user_mail'];
        $query = $dbh->prepare('SELECT * FROM user WHERE user_mail = :user_mail AND user_active = 1');
        $query->execute(['user_mail' => $mail]);
        $user = $query->fetch();

        if ($user) {
            $token = generateToken($user['user_id']);

            // Envoi du mail
            $userName = $user['user_firstname'];
            $recipient = $mail;

            $headers = 'MIME-Version: 1.0\r\n'.
            'Content-type:text/html;charset=UTF-8\r\n'.
            'From: no-reply@admax.website\r\n'.
            'Reply-To: no-reply@admax.website\r\n'.
            'X-Mailer: PHP/' . phpversion();

            $subject = 'Admax - Réinitialisation de votre mot de passe';

            $expiry = new DateTime();
            $expiry->modify('+1 hour');

            $message = file_get_contents('../templates/mails/reset-pwd.html.php');

            try {
                // CODE EN PROD  
                // mail($recipient, $subject, $message, $headers);
                // $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Un mail de réinitialisation vous a été envoyé à '$mail'.", 'start' => time()];
                // header('Location: /');
                // exit;
                // FIN DU CODE EN PROD

                // CODE EN LOCAL
                require '../templates/mails/reset-pwd.html.php';
                exit;
                // FIN DU CODE EN LOCAL
            } catch (Exception $e) {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'L\'envoi de l\'e-mail de réinitialisation a échoué.', 'start' => time()];
            }
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Aucun compte existant avec cette adresse mail.', 'start' => time()];
        }
    }
}