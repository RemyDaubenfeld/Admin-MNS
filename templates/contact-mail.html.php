<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Admax - Réinitialisation de mot de passe</title>
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/mail.css">
    </head>

    <body>
        <div class='mail-container background-dark'>
            <h1><?= $object ?></h1>
            <p><?= $category ?></p>
            <p><?= $body ?></p>
            <small>Envoyé par <?= $userFullName ?> à <?= date('Y-m-d') ?>.</small>
        </div>
    </body>
</html>