<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admax - <?= $title ?></title>
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/disconnected.css">
        <?php if (file_exists("assets/css/$page.css")): ?>
            <link rel="stylesheet" href="assets/css/<?= $page ?>.css">
        <?php endif; ?>
        <script defer src="assets/js/script.js"></script>
        <script defer src="assets/js/modal.js"></script>
        <?php if (file_exists("assets/js/$page.js")): ?>
            <script defer type="module" src="assets/js/<?= $page ?>.js"></script>
        <?php endif; ?>
    </head>
    <body>
        
        <!--Modal-->
        <div id="modal-container-message">
            <div class="success-modal">
                <div class="modal-header">
                    <h4><div><img src="" alt=""></div>Succès</h4>
                    <button class="close-modal"><img src="assets/img/xmark-solid.svg" alt="Fermer la fenêtre"></button>
                </div>
                <div id="modal-message"></div>
            </div>
        </div>
        
        <main>
            <div class="container">
                <?php require "../templates/$page.html.php" ?>
            </div>
        </main>
        
        <footer>
            <div>
                <p>© <?php echo date('Y')?> <a href="https://remy-daubenfeld.fr" target="_blank">Rémy Daubenfeld</a> & <a href="https://github.com/NicolasCoquatrix" target="_blank">Nicolas Coquatrix</a>. Tous droits réservés.</p>
            </div>
        </footer>
    </body>
</html>