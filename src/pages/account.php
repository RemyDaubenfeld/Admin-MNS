<?php

// REQUIRES
require '../src/pages/libs/form-control.php';

// ACCÈS ET DROITS
if (!$isMyAccount) {
    if (!in_array('directory', $connectedUserPagesAccess)) {
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Vous n'avez pas accès à cette page.", 'start' => time()];
        header('Location: /');
        exit;
    } else {
        $isEditable = in_array('directory', $connectedUserPagesUpdate);
    }
} else {
    $isEditable = true;
}

// INFORMATIONS DE LA PAGE
$query = $dbh->prepare("SELECT * FROM user
                        JOIN status ON user.status_id = status.status_id
                        WHERE user_id = :user_id");
$query->execute(['user_id' => $currentUserId]);
$user = $query->fetch();

$currentUserMail = $user['user_mail'];
$currentUserFirstname = $user['user_firstname'];
$currentUserLastname = $user['user_lastname'];
$currentUserFullName = "$currentUserFirstname $currentUserLastname";
$currentUserInitials = strtoupper(substr($currentUserFirstname, 0, 1) . substr($currentUserLastname, 0, 1));
$currentUserGender = $user['user_gender'];
$genders = [1 => 'Homme', 2 => 'Femme'];
$currentUserGenderName = $genders[$currentUserGender] ?? null;
$currentUserPhone = !empty($user['user_phone']) ? $user['user_phone'] : null;
$currentUserAddressNumber = !empty($user['user_address_number']) ? $user['user_address_number'] : null;
$currentUserStreet = !empty($user['user_street']) ? $user['user_street'] : null;
$currentUserZipCode = !empty($user['user_zip_code']) ? $user['user_zip_code'] : null;
$currentUserCity = !empty($user['user_city']) ? $user['user_city'] : null;
$currentUserFullAdress = $currentUserAddressNumber && $currentUserStreet && $currentUserZipCode && $currentUserCity ? "$currentUserAddressNumber $currentUserStreet, $currentUserZipCode $currentUserCity" : null;
$currentUserImage = !empty($user['user_image']) ? $user['user_image'] : null;
$currentUserStatusId = $user['status_id'];
$currentUserStatus= $user['user_gender'] == 2 && !empty($user['status_female_name']) ? $user['status_female_name'] : $user['status_male_name'] ;
$currentUserStaff = $user['status_staff'];

$query = $dbh->prepare('SELECT * FROM page 
                        JOIN page_status ON page.page_id = page_status.page_id
                        WHERE status_id = :status_id');
$query->execute(['status_id' => $currentUserStatusId]);
$currentUserPages = $query->fetchAll();

$pagesWithoutRights = ['index', 'contact', 'account'];
$currentUserPagesAccess = $pagesWithoutRights;
$currentUserPagesUpdate = $pagesWithoutRights;
$currentUserPageAccess = in_array($page, $pagesWithoutRights);
$currentUserPageUpdate = in_array($page, $pagesWithoutRights);

foreach ($currentUserPages as $index => $currentUserPage) {
    $currentUserPagesAccess[] = $currentUserPage['page_link'];
    if ($currentUserPage['page_status_modification'] == 1) {
        $currentUserPagesUpdate[] = $currentUserPage['page_link'];
    }

    if ($currentUserPage['page_link'] == $page) {
        $currentUserPageAccess = true;
        if ($currentUserPage['page_status_modification'] == 1) {
            $currentUserPageUpdate = true;
        }
    }
}

$title = $isMyAccount ? 'Mon compte' : $currentUserFullName;

// MISE A JOUR : MAIL
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mailEdit_hidden_submit'])) {
    $errors = 0;

    $mailData = mailCheck($_POST['mail'] ?? null);
    $errors += $mailData['errors'];
    $mail = $mailData['mail'];

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_mail = :user_mail WHERE user_id = :user_id');
        $query->execute([
            'user_mail' => $mail,
            'user_id' => $currentUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'L\'adresse mail a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$currentUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour de l\'adresse mail.', 'start' => time()];
        }
    }
}

// MISE A JOUR : TÉLÉPHONE
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['phoneEdit_hidden_submit'])) {
    $errors = 0;

    $phoneData = phoneCheck($_POST['phone'] ?? null);
    $errors += $phoneData['errors'];
    $phone = $phoneData['phone'];

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_phone = :user_phone WHERE user_id = :user_id');
        $query->execute([
            'user_phone' => $phone,
            'user_id' => $currentUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le numéro de téléphone a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$currentUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour du numéro de téléphone.', 'start' => time()];
        }
    }
}

// MISE A JOUR : ADRESSE
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addressEdit_hidden_submit'])) {
    $errors = 0;

    $addressData = addressCheck($_POST['addressNumber'] ?? null, $_POST['addressStreet'] ?? null, $_POST['addressZipCode'] ?? null, $_POST['addressCity'] ?? null);
    $errors += $addressData['errors'];
    $addressNumber = $addressData['addressNumber'];
    $addressStreet = $addressData['addressStreet'];
    $addressZipCode = $addressData['addressZipCode'];
    $addressCity = $addressData['addressCity'];

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_address_number = :user_address_number, user_street = :user_street, user_zip_code = :user_zip_code, user_city = :user_city WHERE user_id = :user_id');
        $query->execute([
            'user_address_number' => $addressNumber,
            'user_street' => $addressStreet,
            'user_zip_code' => $addressZipCode,
            'user_city' => $addressCity,
            'user_id' => $currentUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'L\'adresse a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$currentUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour de l\'adresse.', 'start' => time()];
        }
    }
}


// MISE A JOUR : MOT DE PASSE
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['passwordEdit_hidden_submit'])) {  
    $errors = 0;

    $passwordData = changePasswordCheck($_POST['oldPassword'] ?? null, $_POST['newPassword'] ?? null, $_POST['confirmPassword'] ?? null);
    $errors += $passwordData['errors'];
    $password = $passwordData['password'];

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_password = :user_password WHERE user_id = :user_id');
        $query->execute([
            'user_password' => password_hash($password, PASSWORD_DEFAULT),
            'user_id' => $currentUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le mot de passe a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$currentUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour du mot de passe.', 'start' => time()];
        }
    }
}

// MISE A JOUR : GENRE
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['genderEdit_hidden_submit'])) {
    $errors = 0;

    $genderData = genderCheck($_POST['gender'] ?? null);
    $errors += $genderData['errors'];
    $gender = $genderData['gender'];

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_gender = :user_gender WHERE user_id = :user_id');
        $query->execute([
            'user_gender' => $gender,
            'user_id' => $currentUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le genre a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$currentUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour de du genre.', 'start' => time()];
        }
    }
}

// MISE A JOUR : PHOTO DE PROFIL
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_picture_submit'])) {
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

                $filename = $currentUserId . '-' . date('Y-m-d-H-i-s') . '.' . pathinfo($_FILES['profil_picture']['name'])['extension'];

                if (move_uploaded_file($_FILES['profil_picture']['tmp_name'], "assets/uploads/$filename")) {

                    // Suppression de l'ancienne photo dans le dossier uploads
                    $oldProfilPicture = "assets/uploads/$currentUserImage";
                    if(file_exists($oldProfilPicture)) {
                        unlink($oldProfilPicture);
                    }

                    $query = $dbh->prepare('UPDATE user SET user_image = :user_image WHERE user_id = :user_id');
                    $query->execute(['user_image' => $filename, 'user_id' => $currentUserId]);
                    if($query) {
                        $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'L\'image de profil a été modifié avec succès.', 'start' => time()];
                        header("Location: /?page=account&user-id=$currentUserId");
                        exit;
                    } else {
                        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour de l\'image de profil.', 'start' => time()];
                    }
                }
            } else {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'L\'image est trop volumineuse (taille max autorisée : 5 Mo).', 'start' => time()];
            }
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le fichier doit être une image (jpg, jpeg, png).', 'start' => time()];
        }
    } else {
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Echec lors du téléversement du fichier.', 'start' => time()];
    }
}

// MISE A JOUR : NOM
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nameEdit_hidden_submit'])) {
    $errors = 0;

    $firstnameData = firstnameCheck($_POST['firstname'] ?? null);
    $errors += $firstnameData['errors'];
    $firstname = $firstnameData['firstname'];

    $lastnameData = lastnameCheck($_POST['lastname'] ?? null);
    $errors += $lastnameData['errors'];
    $lastname = $lastnameData['lastname'];

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_firstname = :user_firstname, user_lastname = :user_lastname WHERE user_id = :user_id');
        $query->execute([
            'user_firstname' => $firstname,
            'user_lastname' => $lastname,
            'user_id' => $currentUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le prénom et le nom ont été modifiés avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$currentUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour du prénom et du nom.', 'start' => time()];
        }
    }
}

// MISE A JOUR : STATUT
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['statusEdit_hidden_submit'])) {
    $errors = 0;

    $statusData = statusCheck($_POST['status'] ?? null);
    $errors += $statusData['errors'];
    $status = $statusData['status'];

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET status_id = :status_id WHERE user_id = :user_id');
        $query->execute([
            'status_id' => $status,
            'user_id' => $currentUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le statut a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$currentUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour de du statut.', 'start' => time()];
        }
    }
}
