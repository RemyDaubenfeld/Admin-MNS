<?php

require '../src/pages/libs/date-time.php';

session_start(); 

if (!empty($_GET['ajax'])) { // AJAX
    $ajax = $_GET['ajax'];
    $value = !empty($_GET['value']) ? urldecode($_GET['value']) : '';

    $path = "../src/ajax/$ajax.json.php";
    if(file_exists($path)){
        require '../src/data/db-connect.php';
        
        require $path;
    } else {
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Fichier '$ajax' inexistant.", 'start' => time()];
        echo json_encode("Fichier $ajax inexistant.");
        exit;
    }
} else if (!empty($_GET['script'])) { // SCRIPTS
    $script = $_GET['script'];
    $value = !empty($_GET['value']) ? urldecode($_GET['value']) : '';
    
    $path = "../src/scripts/$script.php";
    if(file_exists($path)){
        require '../src/data/db-connect.php';
    
        if (empty($_SESSION['user_id'])) {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Vous devez être connecté.', 'start' => time()];
            header('Location: /');
            exit;
        }
    
        require $path;
    } else {
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Script inexistant.', 'start' => time()];
        header('Location: /');
        exit;
    }
} else { // PAGES
    $page = $_GET['page'] ?? 'index';

    $path = "../src/pages/$page.php";

    $offlinePages = ['connection', 'forgotten-pwd', 'reset-pwd'];
    $layout = in_array($page, $offlinePages) ? 'layout-disconnected' : 'layout-connected' ;

    if(file_exists($path)) {
        require '../src/data/db-connect.php';

        if(!empty($_SESSION['user_id'])) {
            if (in_array($page, $offlinePages)) {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Vous ne pouvez pas accèder à cette page en étant connecté.", 'start' => time()];
                header('Location: /');
                exit;
            }

            require '../src/data/connected-user.php';
        

            if (!$connectedUserPageAccess) {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Vous n'avez pas accès à cette page.", 'start' => time()];
                header('Location: /');
                exit;
            }

            $currentUserId = $_GET['user-id'] ?? $connectedUserId;

            $pagesWithoutRights = ['index', 'contact', 'account'];

            $query = $dbh->prepare('SELECT COUNT(*) AS user FROM user
                                    INNER JOIN status ON user.status_id = status.status_id
                                    INNER JOIN page_status ON status.status_id = page_status.status_id
                                    INNER JOIN page ON page_status.page_id = page.page_id
                                    WHERE user.user_id = :user_id
                                    AND user.user_active = 1
                                    AND (page_status.page_perso = 1 OR page_status.page_perso IS NULL)
                                    AND page.page_link = :page_link;');
            $query->execute([
                'user_id' => $currentUserId,
                'page_link' => $page
            ]);
            $currentUserAccess = $query->fetch();

            if (!$currentUserAccess['user'] && !in_array($page, $pagesWithoutRights)) {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Cette page n'est pas accessible pour cet utilisateur.", 'start' => time()];
                header('Location: /');
                exit;
            }

            $parentPage = $page;
            if ($currentUserId != $connectedUserId) {
                if ($page == 'account') {
                    $parentPage = 'directory';
                } else if ($page == 'lateness') {
                    $parentPage = 'directory';
                }
            }

            $isMyAccount = $currentUserId == $connectedUserId;

            if (!$isMyAccount) {
                $query = $dbh->prepare("SELECT user_id FROM user 
                                    WHERE user_id = :user_id");
                $query->execute(['user_id' => $_GET['user-id']]);
                $existingUser = $query->fetch();
            
                if (!$existingUser) { 
                    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Cet utilisateur n'existe pas ou plus.", 'start' => time()];
                    header('Location: /');
                    exit;
                }
            }
        } else {
            if (!in_array($page, $offlinePages) && empty($_SESSION['user_id'])) {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Vous ne pouvez pas accèder à cette page sans être connecté.", 'start' => time()];
                header('Location: /?page=connection');
                exit;
            }
        }
        require $path;
        require "../templates/layouts/$layout.html.php";
    } else {
        header('HTTP/1.1 404 Not Found');
        require '../templates/404.html.php';
        exit;
    }
}