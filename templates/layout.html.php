<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admax - <?= $title ?? ''?></title>
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/connection.css">
        <link rel="stylesheet" href="assets/css/pages.css">
        <link rel="stylesheet" href="assets/css/modal.css">
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
        
        <?php if (!empty($_SESSION['user_id'])): ?>
            <header>
                <div class="header-left">
                    <img src="assets/img/logo.gif" alt="Logo Admax">
                </div>
                <div class="header-right">
                    <div class="user-status">
                        <div>
                            <p class="name"><?php echo $user['user_firstname'] . ' ' . $user['user_lastname'] ?></p>
                            <p><?php echo $user['status_male_name']?></p>
                        </div>
                        <div id="icon-header">
                            <?php echo isset($user['user_image']) && !empty($user['user_image']) ? "<img src='assets/uploads/" . $user['user_image'] . "' alt='Photo de profil'>" : "<p>" . strtoupper(substr($user['user_firstname'], 0, 1) . substr($user['user_lastname'], 0, 1)) . "</p>"?>
                        </div>
                    </div>
                </div>
            </header>
        
            <main>
                <div class="navigation">
                    <!--Affichage candidat-->
                    <?php if ($user['status_id'] == 1): ?>
                        <div class="list-nav">
                            <a href="/"><img src="assets/img/chart-pie-solid.svg" alt="Tableau de bord">Tableau de bord</a>
                            <a href="/?page=documents"><img src="assets/img/file-solid.svg" alt="Documents">Documents</a>
                        </div>
                        <div class="contact-nav">
                            <a href="/?page=compte"><img src="assets/img/user-solid.svg" alt="Compte">Compte</a>
                            <a href="/?page=contact"><img src="assets/img/message.svg" alt="Contact">Contact</a>
                        </div>
                    <?php endif; ?>

                    <!--Affichage stagiaire-->
                    <?php if ($user['status_id'] == 2): ?>
                        <div class="list-nav">
                            <a href="/"><img src="assets/img/chart-pie-solid.svg" alt="Tableau de bord">Tableau de bord</a>
                            <a href="/?page=planning"><img src="assets/img/calendar-solid.svg" alt="Planning">Planning</a>
                            <a href="/?page=retards"><img src="assets/img/clock-solid.svg" alt="Retards">Retards</a>
                            <a href="/?page=absences"><img src="assets/img/square-xmark-solid.svg" alt="Absences">Absences</a>
                        </div>
                        <div class="contact-nav">
                            <a href="/?page=compte"><img src="assets/img/user-solid.svg" alt="Compte">Compte</a>
                            <a href="/?page=contact">Contact</a>
                        </div>
                    <?php endif; ?>

                    <!--Affichage intervenant-->
                    <?php if ($user['status_id'] == 3): ?>
                        <div class="list-nav">
                            <a href="/"><img src="assets/img/chart-pie-solid.svg" alt="Tableau de bord">Tableau de bord</a>
                            <a href="/?page=planning"><img src="assets/img/calendar-solid.svg" alt="Planning">Planning</a>
                        </div>
                        <div class="contact-nav">
                            <a href="/?page=compte"><img src="assets/img/user-solid.svg" alt="Compte">Compte</a>
                            <a href="/?page=contact"><img src="assets/img/-solid.svg" alt="contact">Contact</a>
                        </div>
                    <?php endif; ?>

                    <!--Affichage assistant administatif-->
                    <?php if ($user['status_id'] == 4): ?>
                        <div class="list-nav">
                            <a href="/"><img src="assets/img/chart-pie-solid.svg" alt="Tableau de bord">Tableau de bord</a>
                            <a href="/?page=planning"><img src="assets/img/calendar-solid.svg" alt="Planning">Planning</a>
                            <a href="/?page=retards"><img src="assets/img/clock-solid.svg" alt="Retards">Retards</a>
                            <a href="/?page=absences"><img src="assets/img/square-xmark-solid.svg" alt="Absences">Absences</a>
                            <a href="/?page=inscriptions"><img src="assets/img/file-lines-solid.svg" alt="Inscriptions">Inscriptions</a>
                        </div>
                        <div class="contact-nav">
                            <a href="/?page=compte"><img src="assets/img/user-solid.svg" alt="Compte">Compte</a>
                        </div>
                    <?php endif; ?>

                    <!--Affichage responsable formation-->
                    <?php if ($user['status_id'] == 5): ?>
                        <div class="list-nav">
                            <a href="/"><img src="assets/img/chart-pie-solid.svg" alt="Tableau de bord">Tableau de bord</a>
                            <a href="/?page=planning"><img src="assets/img/calendar-solid.svg" alt="Planning">Planning</a>
                        </div>
                        <div class="contact-nav">
                            <a href="/?page=compte"><img src="assets/img/user-solid.svg" alt="Compte">Compte</a>
                        </div>
                    <?php endif; ?>

                    <!--Affichage responsable vie scolaire-->
                    <?php if ($user['status_id'] == 6): ?>
                        <div class="list-nav">
                            <a href="/"><img src="assets/img/chart-pie-solid.svg" alt="Tableau de bord">Tableau de bord</a>
                            <a href="/?page=planning"><img src="assets/img/calendar-solid.svg" alt="Planning">Planning</a>
                        </div>
                        <div class="contact-nav">
                            <a href="/?page=compte"><img src="assets/img/user-solid.svg" alt="Compte">Compte</a>
                        </div>
                    <?php endif; ?>
                    
                    <!--Affichage responsable d'établissement-->
                    <?php if ($user['status_id'] == 7): ?>
                        <div class="list-nav">
                            <a href="/"><img src="assets/img/chart-pie-solid.svg" alt="Tableau de bord">Tableau de bord</a>
                            <a href="/?page=planning"><img src="assets/img/calendar-solid.svg" alt="Planning">Planning</a>
                            <a href="/?page=directory"><img src="assets/img/repertory-solid.svg" alt="Répertoire">Répertoire</a>
                        </div>
                        <div class="contact-nav">
                            <a href="/?page=compte"><img src="assets/img/user-solid.svg" alt="Compte">Compte</a>
                            <a href="/?page=contact"><img src="assets/img/message.svg" alt="Contact">Contact</a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="pages">
                    <?php require '../templates/' . $page . '.html.php';?>
                </div>
            </main>
        <?php else: ?>
            <main>
                <?php require '../templates/' . $page . '.html.php';?>
            </main>
        <?php endif; ?>
        
        <footer>
            <div>
                <p>© <?php echo date('Y')?> <a href="https://remy-daubenfeld.fr" target="_blank">Rémy Daubenfeld</a> & <a href="https://github.com/NicolasCoquatrix" target="_blank">Nicolas Coquatrix</a>. Tous droits réservés.</p>
            </div>
        </footer>
        <script src="assets/js/script.js"></script>
        <script src="assets/js/modal.js"></script>
    </body>
</html>