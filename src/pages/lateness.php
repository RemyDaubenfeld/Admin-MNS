<?php

// REQUIRES
require '../src/pages/libs/form-control.php';

// ACCÈS ET DROITS
if (!$isMyAccount) {
    if (!in_array('directory', $connectedUserPagesAccess)) {
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Vous n'avez pas accès à cette page.", 'start' => time()];
        header('Location: /');
        exit;
    }
}

$isEditable = in_array('directory', $connectedUserPagesUpdate);

// INFORMATIONS DE LA PAGE
$query = $dbh->prepare("SELECT * FROM user
                        JOIN status ON user.status_id = status.status_id
                        WHERE user_id = :user_id");
$query->execute(['user_id' => $currentUserId]);
$user = $query->fetch();

$currentUserFullName = $user['user_firstname'].' '.$user['user_lastname'];

$query = $dbh->prepare('SELECT COUNT(*) AS nb_lateness FROM lateness
                        WHERE user_id = :user_id
                        AND lateness_active = 1;');
$query->execute(['user_id' => $currentUserId]);
$allLateness = $query->fetch();

$query = $dbh->prepare("SELECT COUNT(*) AS nb_lateness FROM lateness
                        WHERE lateness_start > '$now'
                        AND user_id = :user_id
                        AND lateness_active = 1;");
$query->execute(['user_id' => $currentUserId]);
$anticipatedLateness = $query->fetch();

$query = $dbh->prepare("SELECT COUNT(*) AS nb_lateness FROM lateness
                        WHERE YEAR(lateness_start) = YEAR('$now')
                        AND lateness_start <= '$now'
                        AND user_id = :user_id
                        AND lateness_active = 1;");
$query->execute(['user_id' => $currentUserId]);
$yearLateness = $query->fetch();

$query = $dbh->prepare("SELECT COUNT(*) AS nb_lateness FROM lateness
                        WHERE YEAR(lateness_start) = YEAR('$now')
                        AND MONTH(lateness_start) = MONTH('$now')
                        AND lateness_start <= '$now'
                        AND user_id = :user_id
                        AND lateness_active = 1;");
$query->execute(['user_id' => $currentUserId]);
$monthLateness = $query->fetch();

$query = $dbh->prepare("SELECT COUNT(*) AS nb_lateness FROM lateness
                        WHERE lateness_start >= '$week_start'
                        AND lateness_start <= '$now'
                        AND user_id = :user_id
                        AND lateness_active = 1;");
$query->execute(['user_id' => $currentUserId]);
$weekLateness = $query->fetch();

$query = $dbh->prepare("SELECT COUNT(*) AS nb_lateness FROM lateness
                        WHERE DATE(lateness_start) = DATE('$now')
                        AND user_id = :user_id
                        AND lateness_active = 1;");
$query->execute(['user_id' => $currentUserId]);
$dayLateness = $query->fetch();


$title = $isMyAccount ? 'Mes retards' : $currentUserFullName;

// PAGINATION
$period = $_GET['period'] ?? null;

$queryStr = 'SELECT COUNT(*) AS nb_lateness FROM lateness 
             WHERE user_id = :user_id
             AND lateness_active = 1';

if ($period == 'anticipated') {
    $queryStr .= " AND lateness_start > '$now'";
} else if ($period == 'year') {
    $queryStr .= " AND YEAR(lateness_start) = YEAR('$now')
                   AND lateness_start <= '$now'";
} else if ($period == 'month') {
    $queryStr .= " AND YEAR(lateness_start) = YEAR('$now')
                   AND MONTH(lateness_start) = MONTH('$now')
                   AND lateness_start <= '$now'";
} else if ($period == 'week') {
    $queryStr .= " AND lateness_start >= '$week_start'
                   AND lateness_start <= '$now'";
} else if ($period == 'day') {
    $queryStr .= " AND DATE(lateness_start) = DATE('$now')";
}

$query = $dbh->prepare($queryStr);
$query->execute(['user_id' => $currentUserId]);
$nbLatness = $query->fetch();

$nbLatness = $nbLatness['nb_lateness'];
$latnessPerPage = 10;
$numPage = !empty($_GET['num-page']) ? intval($_GET['num-page']) : 1;
$offset = ($numPage - 1) * $latnessPerPage;
$totalPages = ceil($nbLatness / $latnessPerPage);

$queryStr = 'SELECT * FROM lateness
             WHERE user_id = :user_id
             AND lateness_active = 1';

if ($period == 'anticipated') {
    $queryStr .= " AND lateness_start > '$now'";
} else if ($period == 'year') {
    $queryStr .= " AND YEAR(lateness_start) = YEAR('$now')
                   AND lateness_start <= '$now'";
} else if ($period == 'month') {
    $queryStr .= " AND YEAR(lateness_start) = YEAR('$now')
                   AND MONTH(lateness_start) = MONTH('$now')
                   AND lateness_start <= '$now'";
} else if ($period == 'week') {
    $queryStr .= " AND lateness_start >= '$week_start'
                   AND lateness_start <= '$now'";
} else if ($period == 'day') {
    $queryStr .= " AND DATE(lateness_start) = DATE('$now')";
}

$queryStr .= " ORDER BY lateness_start DESC, lateness_start DESC
               LIMIT $offset, $latnessPerPage";

$query = $dbh->prepare($queryStr);
$query->execute(['user_id' => $currentUserId]);
$lateness = $query->fetchAll();

foreach($lateness as $index => $iLateness){
    $startTime = new DateTime($iLateness['lateness_start']);
    $endTime = new DateTime($iLateness['lateness_end']);

    $lateness[$index]['lateness_date'] = ucwords($Dateformatter->format($startTime));

    $difference = $startTime->diff($endTime);
    $differenceString = '';
    if ($difference->h > 0) {
        $differenceString .= $difference->h . " heure" . ($difference->h > 1 ? 's' : '');
    }

    if ($difference->h && $difference->i) {
        $differenceString .= ' et ';
    }

    if ($difference->i > 0) {
        $differenceString .= $difference->i . " minute" . ($difference->i > 1 ? 's' : '');
    }

    $lateness[$index]['lateness_difference'] = $differenceString;

    $lateness[$index]['lateness_anticipated'] = $startTime > $nowDateTime;
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addLateness_hidden_submit'])) {
    $errors = 0;

    $dateData = dateCheck($_POST['date']);
    $errors += $dateData['errors'];
    $date = $dateData['date'];

    $startTimeData = startTimeCheck($_POST['startTime']);
    $errors += $startTimeData['errors'];
    $startTime = $startTimeData['startTime'];

    $endTimeData = endTimeCheck($_POST['endTime'], $_POST['startTime']);
    $errors += $endTimeData['errors'];
    $endTime = $endTimeData['endTime'];

    if(empty($errors)) {
        $query = $dbh->prepare('INSERT INTO lateness (lateness_declaration_date, lateness_start, lateness_end, user_id)
                                VALUES (:lateness_declaration_date, :lateness_start, :lateness_end, :user_id)');
        $query->execute([
            'lateness_declaration_date' => $date,
            'lateness_start' => "$date $startTime:00",
            'lateness_end' => "$date $endTime:00",
            'user_id' => $currentUserId,
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le retard a été ajouté avec succès.', 'start' => time()];
            header("Location: /?page=lateness&user-id=$currentUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de l\'ajout du rettard.', 'start' => time()];
        }
    }
}