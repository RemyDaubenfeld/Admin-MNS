<!DOCTYPE html>
<html lang='fr'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title><?= $subject ?></title>
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/mail.css">
    </head>

    <body>
        <div class='mail-container background-dark'>
            <h1><?= $subject ?></h1>
            <p>Bonjour <?= $userName ?>,</p>
            <p>Vous avez demandé une réinitialisation de votre mot de passe. Ce lien est valide pendant 1 heure.</p>
            <form action="http://admax.loc/?page=reset-pwd" method="POST" target="_blank">
                <input type="hidden" name="token" value="<?= $token ?>">
                <button type="submit" class="button button-secondary">Réinitialiser mon mot de passe</button>
            </form>
            <p>Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer ce mail.</p>
            <p>Cordialement,</p>
            <p>L'équipe Admax</p>

            <small>Expiration du lien à <?= $expiry->format('H:i') ?> le <?= $expiry->format('d/m/Y') ?>.</small>
        </div>
    </body>
</html>