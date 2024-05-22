<?php

$title = 'Répertoire';

$query = $dbh->query("SELECT * FROM user JOIN status ON user.status_id = status.status_id ORDER BY user_lastname");
$users = $query->fetchAll();


# Ajout utilisateur
if(isset($_POST['add_user_submit']))
{
    $errors = [];

    if(empty($_POST['add_mail']) || !filter_var($_POST['add_mail'], FILTER_VALIDATE_EMAIL))
        $errors['add_mail'] = "L'adresse mail de l'utilisateur est obligatoire";

    if(empty($_POST['add_lastname']))
        $errors['add_lastname'] = "Le nom de famille de l'utilisateur est obligatoire";

    if(empty($_POST['add_firstname']))
        $errors['add_firstname'] = "Le prénom de l'utilisateur est obligatoire";

    if(empty($_POST['add_phone']))
    $errors['add_phone'] = "Le téléphone de l'utilisateur est obligatoire";

    if(empty($_POST['gender']))
    $errors['gender'] = "Le genre de l'utilisateur est obligatoire";
    
    if(empty($_POST['add_address_number'])) {
        $errors['add_address_number'] = 'Un numéro est obligatoire.';
    }

    if(empty($_POST['add_street'])) {
        $errors['add_street'] = 'Un nom de rue est obligatoire.';
    }

    if(empty($_POST['add_zip_code'])) {
        $errors['add_zip_code'] = 'Un code postal est obligatoire.';
    }

    if(empty($_POST['add_city'])) {
        $errors['add_city'] = 'Un nom de ville est obligatoire.';
    }

    if(empty($_POST['add_country'])) {
        $errors['add_country'] = 'Un nom de pays est obligatoire.';
    }

    if(empty($_POST['add_status'])) {
        $errors['add_status'] = 'Un statut est obligatoire.';
    }

    if(empty($errors)){

        $query = $dbh->prepare("SELECT * FROM user WHERE user_mail = :email");
        $query->execute(['email' => $_POST['add_mail']]);
        $user = $query->fetch();

        if ($user) {
            $errors['add_mail'] = "L'adresse mail de l'utilisateur est déjà utilisée.";
        } else {
            $query = $dbh->prepare("
                INSERT INTO user (user_mail, user_lastname, user_firstname, user_gender, user_phone, user_address_number, user_street, user_zip_code, user_city, user_country, status_id)
                VALUES (:user_mail, :user_lastname, :user_firstname, :user_gender, :user_phone, :user_address_number, :user_street, :user_zip_code, :user_city, :user_country, :status_id )
                ");
            $query->execute([
                'user_mail'=>$_POST['add_mail'],
                'user_lastname'=>$_POST['add_lastname'],
                'user_firstname'=>$_POST['add_firstname'],
                'user_gender'=>$_POST['gender'],
                'user_phone'=>$_POST['add_phone'],
                'user_address_number'=>$_POST['add_address_number'],
                'user_street'=>$_POST['add_street'],
                'user_zip_code'=>$_POST['add_zip_code'],
                'user_city'=>$_POST['add_city'],
                'user_country'=>$_POST['add_country'],
                'status_id'=>$_POST['add_status']
            ]);

            if(!$dbh->lastInsertId())
            {
                $errors['error'] = "Erreur lors de la création de l'utilisateur";
            } else {
                $success = 'Utilisateur ajouté avec succès';
                header('Location: /?page=directory');
                exit;
            }
        }
    }
} 