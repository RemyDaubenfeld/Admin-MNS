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
        $query = $dbh->prepare("SELECT * FROM user WHERE user_mail = :email");
        $query->execute(['email' => $_POST['edit_mail']]);
        $user = $query->fetch();

        if ($user) {
            $errors = "Un utilisateur existe déjà avec cette adresse mail.";
        } else {
            $query = $dbh->prepare("UPDATE user SET user_mail = :user_mail WHERE user_id = :user_id");
            $query->execute(['user_mail' => $_POST['edit_mail'], 'user_id' => $_SESSION['user_id']]);
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
if(isset($_POST['edit_phone_submit'])) {
    $errors = [];
    if (empty($_POST['edit_phone'])) {
        $errors['edit_phone'] = 'Un numéro de téléphone est obligatoire.';
    }
    if(empty($errors)) {
        $query = $dbh->prepare("UPDATE user SET user_phone = :user_phone WHERE user_id = :user_id");
        $query->execute(['user_phone' => $_POST['edit_phone'], 'user_id' => $_SESSION['user_id']]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Le numéro de téléphone a été modifié avec succès.", 'start' => time()];
            header("Location: /?page=account");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la mise à jour.", 'start' => time()];
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
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "L'adresse a été modifié avec succès.", 'start' => time()];
            header("Location: /?page=account");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la mise à jour.", 'start' => time()];
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
    if (empty($_POST['confirm_new_password'])) {
        $errors['confirm_new_password'] = "Le mot de passe est obligatoire.";
    }
    if(empty($errors)) {
        if (($_POST['user_password']) === ($_POST['new_password'])) {
            if (password_verify($_POST['old_password'] . 'mns', $user['user_password'])) {   
                $query = $dbh->prepare("UPDATE user SET user_password = :user_password WHERE user_id = :user_id");
                $query->execute(['user_password' => password_hash($_POST['new_password'] . 'mns', PASSWORD_DEFAULT), 'user_id' => $_SESSION['user_id']]);
                if($query) {
                    $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Le mot de passe a été modifié avec succès.", 'start' => time()];
                    header("Location: /?page=account");
                    exit;
                } else {
                    $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la mise à jour.", 'start' => time()];
                }
            } else {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Le mot de passe est incorrect.", 'start' => time()];
            }
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Les mots de passe doivent être identique.", 'start' => time()];
        }
    }
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
                    $oldProfilPicture = 'assets/uploads/' . $user['user_image'];
                    if(file_exists($oldProfilPicture)) {
                        unlink($oldProfilPicture);
                    }

                    $query = $dbh->prepare("UPDATE user SET user_image = :user_image WHERE user_id = :user_id");
                    $query->execute(['user_image' => $filename, 'user_id' => $_SESSION['user_id']]);
                    if($query) {
                        $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "La photo a été modifié avec succès.", 'start' => time()];
                        header("Location: /?page=account");
                        exit;
                    } else {
                        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Une erreur s'est produite lors de la mise à jour de la photo.", 'start' => time()];
                    }
                }
            } else {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Le fichier est trop volumineux (taille max autorisée: 5 Mo).", 'start' => time()];
            }
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Erreur, le fichier doit être une image (jpg, jpeg, png).", 'start' => time()];
        }
    } else {
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Echec lors du téléversement du fichier.", 'start' => time()];
    }
}