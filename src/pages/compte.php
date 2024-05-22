<?php

if (empty($_SESSION['user_id'])) {
    header('Location: /?page=connection');
    exit;
}

$title = 'Mon compte';

if (isset($_SESSION['user_id'])) {
    $query = $dbh->prepare("SELECT * FROM user JOIN status ON user.status_id = status.status_id WHERE user_id = :user_id");
    $query->execute(['user_id' => $_SESSION['user_id']]);
    $user = $query->fetch();
}


// mise à jour mail
if(isset($_POST['edit_mail_submit'])) {
    $errors = [];
    if (empty($_POST['edit_mail'])) {
        $errors['edit_mail'] = 'Une adresse mail est obligatoire.';
    }
    if(empty($errors)) {
        $query = $dbh->prepare("UPDATE user SET user_mail = :user_mail WHERE user_id = :user_id");
        $query->execute(['user_mail' => $_POST['edit_mail'], 'user_id' => $_SESSION['user_id']]);
        if($query) {
            header("Location: /?page=compte");
            exit;
        } else {
            $errors['error'] = "Une erreur s'est produite lors de la mise à jour.";
        }
    }
}

// mise à jour téléphone
if(isset($_POST['edit_phone_submit'])) {
    $errors = [];
    if (empty($_POST['edit_phone'])) {
        $errors['edit_phone'] = 'Un numéro de téléphone est obligatoire.';
    }
    if(empty($errors)) {
        $query = $dbh->prepare("UPDATE user SET user_phone = :user_phone WHERE user_id = :user_id");
        $query->execute(['user_phone' => $_POST['edit_phone'], 'user_id' => $_SESSION['user_id']]);
        if($query) {
            header("Location: /?page=compte");
            exit;
        } else {
            $errors['error'] = "Une erreur s'est produite lors de la mise à jour.";
        }
    }
}

// mise à jour adresse
if(isset($_POST['edit_location_submit'])) {
    $errors = [];
    if (empty($_POST['edit_address_number'])) {
        $errors['edit_address_number'] = 'Un numéro est obligatoire.';
    }
    if (empty($_POST['edit_street'])) {
        $errors['edit_street'] = 'Un nom de rue est obligatoire.';
    }
    if (empty($_POST['edit_zip_code'])) {
        $errors['edit_zip_code'] = 'Un code postal est obligatoire.';
    }
    if (empty($_POST['edit_city'])) {
        $errors['edit_city'] = 'Un nom de ville est obligatoire.';
    }
    if (empty($_POST['edit_country'])) {
        $errors['edit_country'] = 'Un nom de pays est obligatoire.';
    }
    if(empty($errors)) {
        $query = $dbh->prepare("UPDATE user SET user_address_number = :user_address_number, user_street = :user_street, user_zip_code = :user_zip_code, user_city = :user_city, user_country = :user_country WHERE user_id = :user_id");
        $query->execute(['user_address_number' => $_POST['edit_address_number'], 'user_street' => $_POST['edit_street'], 'user_zip_code' => $_POST['edit_zip_code'], 'user_city' => $_POST['edit_city'], 'user_country' => $_POST['edit_country'], 'user_id' => $_SESSION['user_id']]);
        if($query) {
            header("Location: /?page=compte");
            exit;
        } else {
            $errors['error'] = "Une erreur s'est produite lors de la mise à jour.";
        }
    }
}


// mise à jour mot de passe
if(isset($_POST['edit_password_submit'])) {   
    $errors = [];
    if (empty($_POST['old_password'])) {
        $errors['old_password'] = "Le mot de passe est obligatoire.";
    }
    if (empty($_POST['new_password'])) {
        $errors['new_password'] = "Le mot de passe est obligatoire.";
    }
    if(empty($errors)) {
        if (password_verify($_POST['old_password'] . 'mns', $user['user_password'])) {   
            $query = $dbh->prepare("UPDATE user SET user_password = :user_password WHERE user_id = :user_id");
            $query->execute(['user_password' => password_hash($_POST['new_password'] . 'mns', PASSWORD_DEFAULT), 'user_id' => $_SESSION['user_id']]);
            if($query) {
                header("Location: /?page=compte");
                exit;
            } else {
                $errors['error'] = "Une erreur s'est produite lors de la mise à jour.";
            }
        } else {
            $errors['old_password'] = "Le mot de passe est incorrect.";
        }
    } 
}


// Récupération des initiales de l'utilisateur
if(isset($user['user_image']) && !empty($user['user_image'])) {
    $initials = "<img src='assets/uploads/" . $user['user_image'] . "' alt='Photo de profil'>";
} else {
    $initials = strtoupper(substr($user['user_firstname'], 0, 1) . substr($user['user_lastname'], 0, 1));
}

// Mise à jour photo de profil

if(isset($_POST['edit_picture_submit'])) {
    $error = [];
    if(isset($_FILES['profil_picture']) && $_FILES['profil_picture']['error'] == 0) {
        $authorizedFileTypes = [
            'image/jpeg',
            'image/jpg',
            'image/png',
        ];

        if(in_array(mime_content_type($_FILES['profil_picture']['tmp_name']), $authorizedFileTypes) 
        && $_FILES['profil_picture']['type'] == mime_content_type($_FILES['profil_picture']['tmp_name'])) {
            // On vérifie le poid du fichier
            if($_FILES['profil_picture']['size'] <= 5000000) {

                $filename = $user['user_id'] . "-" . date("Y-m-d-H-i-s") . '.' . pathinfo($_FILES['profil_picture']['name'])['extension'];

                if (move_uploaded_file($_FILES['profil_picture']['tmp_name'], 'assets/uploads/'. $filename)) {

                    // Suppression de l'ancienne photo dans le dossier uploads
                    $old_profil_picture = 'assets/uploads/' . $user['user_image'];
                    if(file_exists($old_profil_picture)) {
                        unlink($old_profil_picture);
                    }

                    $query = $dbh->prepare("UPDATE user SET user_image = :user_image WHERE user_id = :user_id");
                    $query->execute(['user_image' => $filename, 'user_id' => $_SESSION['user_id']]);
                    if($query) {
                        header("Location: /?page=compte");
                        exit;
                    } else {
                        $error['profil_picture'] = "Une erreur s'est produite lors de la mise à jour de la photo.";
                    }
                }
            } else {
                $error['profil_picture'] = "Le fichier est trop volumineux (taille max autorisée: 5 Mo).";
            }
        } else {
            $error['profil_picture'] = "Erreur, le fichier doit être une image (jpg, jpeg, png).";
        }
    } else {
        $error['profil_picture'] = "Erreur lors du téléversement du fichier.";
    }
}

//deconnexion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['disconnection_submit'])) {
    session_destroy();
    header('Location: /');
}