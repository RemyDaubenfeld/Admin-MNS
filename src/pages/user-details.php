<?php

$title = 'Répertoire';

if (isset($_GET['user_details_id'])) {
    $query = $dbh->prepare("SELECT * FROM user JOIN status ON user.status_id = status.status_id WHERE user_id = :user_id");
    $query->execute(['user_id' => $_GET['user_details_id']]);
    $userDetails = $query->fetch();
}

// mise à jour mail
if(isset($_POST['edit_mail_user_details_submit'])) {
    $errors = [];
    if (empty($_POST['edit_mail_user_details'])) {
        $errors['edit_mail_user_details'] = 'Une adresse mail est obligatoire.';
    }
    if(empty($errors)) {
        $query = $dbh->prepare("SELECT * FROM user WHERE user_mail = :email");
        $query->execute(['email' => $_POST['edit_mail_user_details']]);
        $user = $query->fetch();

        if ($user) {
            $errors = "Un utilisateur existe déjà avec cette adresse mail.";
        } else {
            $query = $dbh->prepare("UPDATE user SET user_mail = :user_mail WHERE user_id = :user_id");
            $query->execute(['user_mail' => $_POST['edit_mail_user_details'], 'user_id' => $_GET['user_details_id']]);
            if($query) {
                $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "L'adresse mail a été modifié avec succès.", 'start' => time()];
                header("Location: /?page=account");
                exit;
            } else {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la mise à jour.", 'start' => time()];
            }
        }
    }
}

// mise à jour téléphone
if(isset($_POST['edit_phone_user_details_submit'])) {
    $errors = [];
    if (empty($_POST['edit_phone_user_details'])) {
        $errors['edit_phone_user_details'] = 'Un numéro de téléphone est obligatoire.';
    }
    if(empty($errors)) {
        $query = $dbh->prepare("UPDATE user SET user_phone = :user_phone WHERE user_id = :user_id");
        $query->execute(['user_phone' => $_POST['edit_phone_user_details'], 'user_id' => $_GET['user_details_id']]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Le numéro de téléphone a été modifié avec succès.", 'start' => time()];
            header("Location: /?page=user-details&user_details_id=".$_GET['user_details_id']);
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la mise à jour.", 'start' => time()];
        }
    }
}

// mise à jour adresse
if(isset($_POST['edit_location_user_details_submit'])) {
    $errors = [];
    if (empty($_POST['edit_address_number_user_details'])) {
        $errors['edit_address_number_user_details'] = 'Un numéro est obligatoire.';
    }
    if (empty($_POST['edit_street_user_details'])) {
        $errors['edit_street_user_details'] = 'Un nom de rue est obligatoire.';
    }
    if (empty($_POST['edit_zip_code_user_details'])) {
        $errors['edit_zip_code_user_details'] = 'Un code postal est obligatoire.';
    }
    if (empty($_POST['edit_city_user_details'])) {
        $errors['edit_city_user_details'] = 'Un nom de ville est obligatoire.';
    }
    if (empty($_POST['edit_country_user_details'])) {
        $errors['edit_country_user_details'] = 'Un nom de pays est obligatoire.';
    }
    if(empty($errors)) {
        $query = $dbh->prepare("UPDATE user SET user_address_number = :user_address_number, user_street = :user_street, user_zip_code = :user_zip_code, user_city = :user_city, user_country = :user_country WHERE user_id = :user_id");
        $query->execute([
            'user_address_number' => $_POST['edit_address_number_user_details'], 
            'user_street' => $_POST['edit_street_user_details'], 
            'user_zip_code' => $_POST['edit_zip_code_user_details'], 
            'user_city' => $_POST['edit_city_user_details'], 
            'user_country' => $_POST['edit_country_user_details'], 
            'user_id' => $_GET['user_details_id']
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "L'adresse a été modifié avec succès.", 'start' => time()];
            header("Location: /?page=user-details&user_details_id=".$_GET['user_details_id']);
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la mise à jour.", 'start' => time()];
        }
    }
}

// mise à jour genre
if(isset($_POST['edit_gender_user_details_submit'])) {
    $errors = [];
    if (empty($_POST['edit_gender_user_details'])) {
        $errors['edit_gender_user_details'] = "Le genre de l'utilisateur est obligatoire.";
    }

    if(empty($errors)) {
        $query = $dbh->prepare("UPDATE user SET user_gender = :user_gender WHERE user_id = :user_id");
        $query->execute(['user_gender' => $_POST['edit_gender_user_details'], 'user_id' => $_GET['user_details_id']]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Le genre de l'utilisateur a été modifié avec succès.", 'start' => time()];
            header("Location: /?page=user-details&user_details_id=".$_GET['user_details_id']);
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la mise à jour.", 'start' => time()];
        }
    }
}

// mise à jour nom
if(isset($_POST['edit_name_user_details_submit'])) {
    $errors = [];
    if (empty($_POST['edit_lastname'])) {
        $errors['edit_lastname'] = "Le nom de famille est obligatoire.";
    }
    if (empty($_POST['edit_firstname'])) {
        $errors['edit_firstname'] = "Le prénom est obligatoire.";
    }  
    if(empty($errors)) {
        $query = $dbh->prepare("UPDATE user SET user_lastname = :user_lastname, user_firstname = :user_firstname WHERE user_id = :user_id");
        $query->execute(['user_lastname' => $_POST['edit_lastname'], 'user_firstname' => $_POST['edit_firstname'], 'user_id' => $_GET['user_details_id']]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Le nom de l'utilisateur a été modifié avec succès.", 'start' => time()];
            header("Location: /?page=user-details&user_details_id=".$_GET['user_details_id']);
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la mise à jour.", 'start' => time()];
        }
    }
}

// mise à jour statut
if(isset($_POST['edit_status_user_details_submit'])) {
    $errors = [];
    if (empty($_POST['edit_status'])) {
        $errors['edit_status'] = "Le statut de l'utilisateur est obligatoire.";
    }
    if(empty($errors)) {
        $query = $dbh->prepare("UPDATE user SET status_id = :status_id WHERE user_id = :user_id");
        $query->execute(['status_id' => $_POST['edit_status'], 'user_id' => $_GET['user_details_id']]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Le statut de l'utilisateur a été modifié avec succès.", 'start' => time()];
            header("Location: /?page=user-details&user_details_id=".$_GET['user_details_id']);
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la mise à jour.", 'start' => time()];
        }
    }
}

// archivage utilisateur
if(isset($_POST['archive_user_submit'])) {
    $query = $dbh->prepare("UPDATE user set user_active = false WHERE user_id = :user_id");
    $query->execute(['user_id' => $_GET['user_details_id']]);
    if($query) {
        $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "L'utilisateur a été archivé avec succès.", 'start' => time()];
        header("Location: /?page=directory");
        exit;
    } else {
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite , veuillez réessayer.", 'start' => time()];
    }
}




// Récupération des initiales de l'utilisateur
if(isset($userDetails['user_image']) && !empty($userDetails['user_image'])) {
    $initials = "<img src='assets/uploads/" . $userDetails['user_image'] . "' alt='Photo de profil'>";
} else {
    $initials = strtoupper(substr($userDetails['user_firstname'], 0, 1) . substr($userDetails['user_lastname'], 0, 1));
}