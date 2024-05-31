<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admax - <?= $title ?></title>
        <link rel="stylesheet" href="assets/css/main.css">
        <link rel="stylesheet" href="assets/css/modal.css">
        <link rel="stylesheet" href="assets/css/connected.css">
        <?php if (file_exists("assets/css/$page.css")): ?>
            <link rel="stylesheet" href="assets/css/<?= $page ?>.css">
        <?php endif; ?>
        <script defer src="assets/js/script.js"></script>
        <script defer src="assets/js/modal.js"></script>
        <script defer type="module" src="assets/js/main.js"></script>
        <?php if (file_exists("assets/js/$page.js")): ?>
            <script defer type="module" src="assets/js/<?= $page ?>.js"></script>
        <?php endif; ?>
    </head>
    <body>
        
        <header>
            <div class="header-left">
                <img src="assets/img/logo.gif" alt="Logo Admax">
            </div>
            <div class="header-right">
                <a href="/?page=account" class="user-status">
                    <div class="user-infos">
                        <p><?= $user['user_firstname'].' '.$user['user_lastname'] ?></p>
                        <p><?= $user['user_gender'] == 1 ? $user['status_female_name'] : $user['status_male_name'] ?></p>
                    </div>
                    <div class="icon-header">
                        <?php if(!empty($user['user_image']) && file_exists('assets/uploads/'.$user['user_image'])): ?>
                            <img src="assets/uploads/<?= $user['user_image'] ?>" alt="Photo de profil">
                        <?php else: ?>
                            <p><?= strtoupper(substr($user['user_firstname'], 0, 1) . substr($user['user_lastname'], 0, 1)) ?></p>
                        <?php endif; ?>
                    </div>
                </a>
            </div>
        </header>

        <div class="main-container">
            <nav class="navigation background-dark">
                <div class="navigation-box">
                    <a href="/" class="navigation-link<?= $page == 'index' ? ' navigation-active' : '' ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"> <!-- Icone Dashboard -->
                            <path d="M304 240V16.6c0-9 7-16.6 16-16.6C443.7 0 544 100.3 544 224c0 9-7.6 16-16.6 16H304zM32 272C32 150.7 122.1 50.3 239 34.3c9.2-1.3 17 6.1 17 15.4V288L412.5 444.5c6.7 6.7 6.2 17.7-1.5 23.1C371.8 495.6 323.8 512 272 512C139.5 512 32 404.6 32 272zm526.4 16c9.3 0 16.6 7.8 15.4 17c-7.7 55.9-34.6 105.6-73.9 142.3c-6 5.6-15.4 5.2-21.2-.7L320 288H558.4z"/>
                        </svg>
                        <p class="navigation-text">Tableau de bord</p>
                    </a>
                    <?php foreach ($userPages as $userPage): ?>
                        <a href="/?page=<?= $userPage['page_link'] ?>" class="navigation-link<?= $page == $userPage['page_link'] ? ' navigation-active' : '' ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="<?= $userPage['page_icone_viewBox'] ?>"> <!-- Icone de l'onglet -->
                                <path d="<?= $userPage['page_icone_path'] ?>"/>
                            </svg>
                            <p class="navigation-text"><?= $userPage['page_name'] ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>

                <div class="navigation-box">
                    <?php if ($userStaff == 1): ?>
                        <a href="/?page=contact" class="navigation-link<?= $page == 'contact' ? ' navigation-active' : '' ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"> <!-- Icone Contact -->
                                <path d="M64 0C28.7 0 0 28.7 0 64V352c0 35.3 28.7 64 64 64h96v80c0 6.1 3.4 11.6 8.8 14.3s11.9 2.1 16.8-1.5L309.3 416H448c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H64z"/>
                            </svg>
                            <p class="navigation-text">Contact</p>
                        </a>
                    <?php endif; ?>
                    <a href="/?page=account" class="navigation-link<?= $page == 'account' ? ' navigation-active' : '' ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"> <!-- Icone Compte -->
                            <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                        </svg>
                        <p class="navigation-text">Compte</p>
                    </a>
                </div>
            </nav>
            
            <main class="pages">
                <?php require "../templates/$page.html.php";?>
                <?php require '../templates/modal-messages.html.php';?>
            </main>
        </div>
        
        <footer>
            <div>
                <p>© <?php echo date('Y')?> <a href="https://remy-daubenfeld.fr" target="_blank">Rémy Daubenfeld</a> & <a href="https://github.com/NicolasCoquatrix" target="_blank">Nicolas Coquatrix</a>. Tous droits réservés.</p>
            </div>
        </footer>
    </body>
</html>