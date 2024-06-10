<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admax - <?= $title ?></title>
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/modal.css">
        <link rel="stylesheet" href="assets/css/disconnected.css">
        <?php if (file_exists("assets/css/$page.css")): ?>
            <link rel="stylesheet" href="assets/css/<?= $page ?>.css">
        <?php endif; ?>
        <script defer type="module" src="assets/js/main.js"></script>
        <?php if (file_exists("assets/js/$page.js")): ?>
            <script defer type="module" src="assets/js/<?= $page ?>.js"></script>
        <?php endif; ?>
    </head>
    <body class="full-screen">
        
        <main>
            <div class="container">
                <?php require "../templates/$page.html.php" ?>
            </div>
            <?php require '../templates/modal-messages.html.php';?>
        </main>
        
        <footer>
            <div>
                <p>© <?php echo date('Y')?> <a href="https://remy-daubenfeld.fr" target="_blank">Rémy Daubenfeld</a> & <a href="https://github.com/NicolasCoquatrix" target="_blank">Nicolas Coquatrix</a>. Tous droits réservés.</p>
            </div>
        </footer>
    </body>
</html>