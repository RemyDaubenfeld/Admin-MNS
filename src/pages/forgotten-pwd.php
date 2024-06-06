<?php

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
        $query = $dbh->prepare('SELECT * FROM user WHERE user_mail = :user_mail AND user_active = 1');
        $query->execute(['user_mail' => $email]);
        $user = $query->fetch();

        if ($user) {
            $userName = $user['user_firstname'];

            $token = bin2hex(random_bytes(32));

            $query = $dbh->prepare('SELECT user_token FROM user WHERE user_token = :user_token');
            $query->execute(['user_token' => $token]);
            $existingToken = $query->fetch();

            do {
                $token = bin2hex(random_bytes(32));

                $query = $dbh->prepare('SELECT user_token FROM user WHERE user_token = :user_token');
                $query->execute(['user_token' => $token]);
                $existingToken = $query->fetch();
            } while ($existingToken);

            $query = $dbh->prepare('UPDATE user SET user_token = :user_token, user_token_valid = :user_token_valid WHERE user_id = :user_id AND user_active = 0');
            $query->execute([
                'user_token' => $token,
                'user_token_valid' => date('Y-m-d H:i:s'),
                'user_id' => $user['user_id']
            ]);

            // Envoi du mail
            $recipient = $email;

            $headers = 'MIME-Version: 1.0\r\n'.
            'Content-type:text/html;charset=UTF-8\r\n'.
            'From: no-reply@admax.website\r\n'.
            'Reply-To: no-reply@admax.website\r\n'.
            'X-Mailer: PHP/' . phpversion();

            $subject = 'Admax - Réinitialisation de votre mot de passe';

            $expiry = new DateTime();
            $expiry->modify('+1 hour');

            $message = file_get_contents('../templates/reset-pwd-mail.html.php');

            try {
                // CODE EN PROD  
                // mail($recipient, $subject, $message, $headers);
                // $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Un mail de réinitialisation vous a été envoyé à '$email'.", 'start' => time()];
                // header('Location: /');
                // exit;
                // FIN DU CODE EN PROD

                // CODE EN LOCAL
                require '../templates/reset-pwd-mail.html.php';
                exit;
                // FIN DU CODE EN LOCAL
            } catch (Exception $e) {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'L\'envoi de l\'e-mail de réinitialisation a échoué.', 'start' => time()];
            }
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Cette adresse email n\'existe pas.', 'start' => time()];
        }
    }
}