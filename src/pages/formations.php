<?php

if (empty($_SESSION['user_id'])) {
    header('Location: /?page=connection');
    exit;
}

$title = 'Formations';

$query = $dbh->query("SELECT * FROM sector WHERE sector_active = true ORDER BY sector_name");
$sectors = $query->fetchAll();

$query = $dbh->query("SELECT * FROM subject WHERE subject_active = true ORDER BY subject_name");
$subjects = $query->fetchAll();

$query = $dbh->query("SELECT * FROM formation JOIN sector ON formation.sector_id = sector.sector_id WHERE formation_active = true ORDER BY formation_name");
$formations = $query->fetchAll();

# Ajout formation
if (isset($_POST['add_formation_submit'])) {
    $errors = [];

    if (empty($_POST['add_name']))
        $errors['add_name'] = "Le nom de la formation est obligatoire.";

    if (empty($_POST['add_level']))
        $errors['add_level'] = "Le niveau de la formation est obligatoire.";

    if (empty($_POST['add_duration']))
        $errors['add_duration'] = "La durée de la formation est obligatoire.";


    if (empty($_POST['add_sector'])) {
        $errors['add_sector'] = 'Le secteur d\'activité de la formation est obligatoire.';
    }

    if (empty($errors)) {

        $query = $dbh->prepare("SELECT * FROM formation WHERE formation_name = :formation_name");
        $query->execute(['formation_name' => $_POST['add_name']]);
        $formation = $query->fetch();

        if ($formation) {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une formation existe déjà avec ce nom.", 'start' => time()];
        } else {
            $query = $dbh->prepare("
                INSERT INTO formation (formation_name, formation_level, formation_duration, formation_active, sector_id)
                VALUES (:formation_name, :formation_level, :formation_duration, :formation_active, :sector_id)
                ");
            $query->execute([
                'formation_name' => $_POST['add_name'],
                'formation_level' => $_POST['add_level'],
                'formation_duration' => $_POST['add_duration'],
                'formation_active' => true,
                'sector_id' => $_POST['add_sector']
            ]);

            if (!$dbh->lastInsertId()) {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Echec lors de la création de la formation.", 'start' => time()];
            } else {
                $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Formation ajouté avec succès.", 'start' => time()];
                header('Location: /?page=formations');
                exit;
            }
        }
    }
}


if (isset($_POST['add_sector_submit'])) {
    $errors = [];

    if (empty($_POST['sector_name']))
        $errors['sector_name'] = "Le nom du secteur est obligatoire.";

    if (empty($errors)) {

        $query = $dbh->prepare("SELECT * FROM sector WHERE sector_name = :sector_name");
        $query->execute(['sector_name' => $_POST['sector_name']]);
        $sector = $query->fetch();

        if ($sector) {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Un secteur existe déjà avec ce nom.", 'start' => time()];
        } else {
            $query = $dbh->prepare("INSERT INTO sector (sector_name, sector_active) VALUES (:sector_name, :sector_active)");
            $query->execute([
                'sector_name' => $_POST['sector_name'],
                'sector_active' => true,
            ]);

            if (!$dbh->lastInsertId()) {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Echec lors de la création du secteur.", 'start' => time()];
            } else {
                $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Secteur ajouté avec succès.", 'start' => time()];
                header('Location: /?page=formations');
                exit;
            }
        }
    }
}

if (isset($_POST['add_subject_submit'])) {
    $errors = [];

    if (empty($_POST['subject_name']))
        $errors['subject_name'] = "Le nom du secteur est obligatoire.";

    if (empty($errors)) {

        $query = $dbh->prepare("SELECT * FROM subject WHERE subject_name = :subject_name");
        $query->execute(['subject_name' => $_POST['subject_name']]);
        $subject = $query->fetch();

        if ($subject) {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une matière existe déjà avec ce nom.", 'start' => time()];
        } else {
            $query = $dbh->prepare("INSERT INTO subject (subject_name, subject_active) VALUES (:subject_name, :subject_active)");
            $query->execute([
                'subject_name' => $_POST['subject_name'],
                'subject_active' => true,
            ]);

            if (!$dbh->lastInsertId()) {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Echec lors de la création de la matière.", 'start' => time()];
            } else {
                $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Matière ajouté avec succès.", 'start' => time()];
                header('Location: /?page=formations');
                exit;
            }
        }
    }
}