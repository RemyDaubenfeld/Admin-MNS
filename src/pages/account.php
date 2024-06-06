<?php

// if (empty($_GET['user-id'])) {
//     $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Impossible d'accèder à cette page sans spécifier l'utilisateur recherché.", 'start' => time()];
//     header('Location: /');
//     exit;
// }

// if(!empty($_POST) && !empty($_FILES)) {
//     var_dump($_POST);
//     var_dump($_FILES);
//     exit;
// }

// if(!empty($_POST)) {
//     var_dump($_POST);
//     exit;
// }

$isMyAccount = $_GET['user-id'] == $_SESSION['user_id'];

if (!$isMyAccount) {
    $query = $dbh->prepare("SELECT * FROM user 
                        WHERE user_id = :user_id");
    $query->execute(['user_id' => $_GET['user-id']]);
    $existingUser = $query->fetch();

    if (!$existingUser) { 
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Cet utilisateur n'existe pas ou plus.", 'start' => time()];
        header('Location: /');
        exit;
    }

    if (!in_array('directory', $userPagesAccess)) {
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => "Vous n'avez pas accès à cette page.", 'start' => time()];
        header('Location: /');
        exit;
    } else {
        $isEditable = in_array('directory', $userPagesUpdate);
    }
} else {
    $isEditable = true;
}

$query = $dbh->prepare("SELECT * FROM user 
                        JOIN status ON user.status_id = status.status_id
                        WHERE user_id = :user_id");
$query->execute(['user_id' => $_GET['user-id']]);
$accountUser = $query->fetch();

$accountUserId = $accountUser['user_id'];
$accountUserMail = $accountUser['user_mail'];
$accountUserFirstname = $accountUser['user_firstname'];
$accountUserLastname = $accountUser['user_lastname'];
$accountUserFullName = "$accountUserFirstname $accountUserLastname";
$accountUserInitials = strtoupper(substr($accountUserFirstname, 0, 1) . substr($accountUserLastname, 0, 1));
$accountUserGender = $accountUser['user_gender'];
$genders = [1 => 'Homme', 2 => 'Femme'];
$accountUserGenderName = $genders[$accountUserGender] ?? null;
$accountUserPhone = $accountUser['user_phone'];
$accountUserAddressNumber = $accountUser['user_address_number'];
$accountUserStreet = $accountUser['user_street'];
$accountUserZipCode = $accountUser['user_zip_code'];
$accountUserCity = $accountUser['user_city'];
$accountUserCountry = $accountUser['user_country'];
$accountUserFullAdress = "$accountUserAddressNumber $accountUserStreet, $accountUserZipCode $accountUserCity, $accountUserCountry";
$accountUserImage = $accountUser['user_image'];
$accountUserStatus= $accountUser['user_gender'] == 2 && !empty($accountUser['status_female_name']) ? $accountUser['status_female_name'] : $accountUser['status_male_name'] ;
$accountUserStaff = $accountUser['status_staff'];

$title = $isMyAccount ? 'Mon compte' : $accountUserFullName;

// MISE A JOUR : MAIL
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mailEdit_hidden_submit'])) {
    $errors = 0;

    if (empty($_POST['mail'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mail est obligatoire.', 'start' => time()];
    } else {
        $mail = $_POST['mail'];
    }

    if(strlen($mail) > 50) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'L\'adresse mail ne doit pas dépasser 50 caractères.', 'start' => time()];
    }

    if(!preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))+$/i', $mail)){
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Cette adresse mail est incorrect.', 'start' => time()];
    }

    // Teste si l'email est libre
    $query = $dbh->prepare('SELECT user_mail FROM user WHERE user_mail = :user_mail;');
    $query->execute(['user_mail' => $mail]);
    $existingMail = $query->fetch();

    if($existingMail) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Cette adresse mail est déjà utilisé.', 'start' => time()];
    }

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_mail = :user_mail WHERE user_id = :user_id');
        $query->execute([
            'user_mail' => $mail,
            'user_id' => $accountUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'L\'adresse mail a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$accountUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour de l\'adresse mail.', 'start' => time()];
        }
    }
}

// MISE A JOUR : TÉLÉPHONE
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['phoneEdit_hidden_submit'])) {
    $errors = 0;

    if (empty($_POST['phone'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le numéro de téléphone est obligatoire.', 'start' => time()];
    } else {
        $phone = $_POST['phone'];
    }

    if(strlen($phone) < 9 || strlen($phone) > 17) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le numéro doit comporter entre 9 et 17 caractères.', 'start' => time()];
    }

    // Formatage du numéro
    $phone = preg_replace('/^(\+33|0)/', '', $phone);
    $phone = preg_replace('/[ .-]/', '', $phone);
    if (strlen($phone) == 9) {
        $phone = "0$phone";
    }

    if(!preg_match('/^(0|\+33\s?)[1-9]([ .-]?\d{2}){4}$/', $phone)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le numéro est incorrect.', 'start' => time()];
    }

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_phone = :user_phone WHERE user_id = :user_id');
        $query->execute([
            'user_phone' => $phone,
            'user_id' => $accountUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le numéro de téléphone a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$accountUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour du numéro de téléphone.', 'start' => time()];
        }
    }
}

// MISE A JOUR : ADRESSE
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addressEdit_hidden_submit'])) {
    $errors = 0;

    if (empty($_POST['addressNumber'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le numéro est obligatoire.', 'start' => time()];
    } else {
        $addressNumber = $_POST['addressNumber'];
    }

    if (empty($_POST['addressStreet'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom de la rue est obligatoire.', 'start' => time()];
    } else {
        $addressStreet = $_POST['addressStreet'];
    }

    if (empty($_POST['addressZipCode'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le code postal est obligatoire.', 'start' => time()];
    } else {
        $addressZipCode = $_POST['addressZipCode'];
    }

    if (empty($_POST['addressCity'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom de la ville est obligatoire.', 'start' => time()];
    } else {
        $addressCity = $_POST['addressCity'];
    }

    if(strlen($addressNumber) < 1 || strlen($addressNumber) > 10) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le numéro doit comporter entre 1 et 10 caractères.', 'start' => time()];
    }

    if(strlen($addressStreet) < 1 || strlen($addressStreet) > 50) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom de la rue doit comporter entre 1 et 50 caractères.', 'start' => time()];
    }

    if(strlen($addressZipCode) != 5 || !ctype_digit($addressZipCode)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le code postal doit comporter 5 chiffres.', 'start' => time()];
    }

    if(strlen($addressCity) < 1 || strlen($addressCity) > 10) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom de la ville doit comporter entre 1 et 10 caractères.', 'start' => time()];
    }

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_address_number = :user_address_number, user_street = :user_street, user_zip_code = :user_zip_code, user_city = :user_city WHERE user_id = :user_id');
        $query->execute([
            'user_address_number' => $addressNumber,
            'user_street' => $addressStreet,
            'user_zip_code' => $addressZipCode,
            'user_city' => $addressCity,
            'user_id' => $accountUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'L\'adresse a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$accountUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour de l\'adresse.', 'start' => time()];
        }
    }
}


// MISE A JOUR : MOT DE PASSE
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['passwordEdit_hidden_submit'])) {  
    $errors = 0;

    if (empty($_POST['oldPassword'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mot de passe actuel est obligatoire', 'start' => time()];
    } else {
        $oldPassword = $_POST['oldPassword'];
    }

    if (empty($_POST['newPassword'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nouveau mot de passe est obligatoire.', 'start' => time()];
    } else {
        $newPassword = $_POST['newPassword'];
    }

    if (empty($_POST['confirmPassword'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'La confirmation du mot de passe est obligatoire.', 'start' => time()];
    } else {
        $confirmPassword = $_POST['confirmPassword'];
    }

    if(strlen($newPassword) < 8 || strlen($newPassword) > 40) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mot de passe doit comporter entre 8 et 40 caractères.', 'start' => time()];
    }

    if(!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $newPassword)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mot de passe doit comporter entre 8 et 40 caractères et contenir au minimum une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).', 'start' => time()];
    }

    if ($newPassword != $confirmPassword) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Les nouveaux mots de passe doivent être identique.', 'start' => time()];
    }

    if(empty($errors)) {
        if (password_verify($oldPassword . 'mns', $userPassword)) {   
            $query = $dbh->prepare('UPDATE user SET user_password = :user_password WHERE user_id = :user_id');
            $query->execute([
                'user_password' => password_hash($newPassword . 'mns', PASSWORD_DEFAULT),
                'user_id' => $userId
            ]);
            if($query) {
                $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le mot de passe a été modifié avec succès.', 'start' => time()];
                header("Location: /?page=account&user-id=$userId");
                exit;
            } else {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour du mot de passe.', 'start' => time()];
            }
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mot de passe actuel saisi est incorrect.', 'start' => time()];
        }
    }
}

// MISE A JOUR : GENRE
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['genderEdit_hidden_submit'])) {
    $errors = 0;

    if (empty($_POST['gender'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le genre est obligatoire (merci de cocher la case \'Non renseigné\' pour ne pas renseigner votre genre).', 'start' => time()];
    } else {
        $gender = $_POST['gender'];
    }

    if($gender != 1 && $gender != 2 && $gender != 3) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Ce genre n\'existe pas.', 'start' => time()];
    }

    if ($gender == 3){
        $gender = null;
    }

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_gender = :user_gender WHERE user_id = :user_id');
        $query->execute([
            'user_gender' => $gender,
            'user_id' => $accountUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le genre a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$accountUserId");
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

                $filename = $accountUserId . '-' . date('Y-m-d-H-i-s') . '.' . pathinfo($_FILES['profil_picture']['name'])['extension'];

                if (move_uploaded_file($_FILES['profil_picture']['tmp_name'], "assets/uploads/$filename")) {

                    // Suppression de l'ancienne photo dans le dossier uploads
                    $oldProfilPicture = "assets/uploads/$accountUserImage";
                    if(file_exists($oldProfilPicture)) {
                        unlink($oldProfilPicture);
                    }

                    $query = $dbh->prepare('UPDATE user SET user_image = :user_image WHERE user_id = :user_id');
                    $query->execute(['user_image' => $filename, 'user_id' => $accountUserId]);
                    if($query) {
                        $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'L\'image de profil a été modifié avec succès.', 'start' => time()];
                        header("Location: /?page=account&user-id=$accountUserId");
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

    if (empty($_POST['firstname'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le prénom est obligatoire.', 'start' => time()];
    } else {
        $firstname = $_POST['firstname'];
    }

    if (empty($_POST['lastname'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom est obligatoire.', 'start' => time()];
    } else {
        $lastname = $_POST['lastname'];
    }

    if(strlen($firstname) < 1 || strlen($firstname) > 50) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le prénom doit comporter entre 1 et 50 caractères.', 'start' => time()];
    }

    if(strlen($lastname) < 1 || strlen($lastname) > 50) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom doit comporter entre 1 et 50 caractères.', 'start' => time()];
    }

    if(!preg_match("/^[a-zà-öø-ÿ' -]+$/i", $firstname)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mot de passe doit comporter entre 8 et 40 caractères et contenir au minimum une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).', 'start' => time()];
    }

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET user_gender = :user_gender WHERE user_id = :user_id');
        $query->execute([
            'user_gender' => $gender,
            'user_id' => $accountUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le genre a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$accountUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour de du genre.', 'start' => time()];
        }
    }
}

// MISE A JOUR : STATUT
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['statusEdit_hidden_submit'])) {
    $errors = 0;

    if (empty($_POST['status'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le statut est obligatoire.', 'start' => time()];
    } else {
        $status = $_POST['status'];
    }

    $query = $dbh->prepare('SELECT status_id FROM status WHERE status_id = :status_id');
    $query->execute(['status_id' => $status]);
    $existingStatus = $query->fetch();

    if(!$existingStatus) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Ce statut n\'existe pas.', 'start' => time()];
    }

    if(empty($errors)) {
        $query = $dbh->prepare('UPDATE user SET status_id = :status_id WHERE user_id = :user_id');
        $query->execute([
            'status_id' => $status,
            'user_id' => $accountUserId
        ]);
        if($query) {
            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'Le statut a été modifié avec succès.', 'start' => time()];
            header("Location: /?page=account&user-id=$accountUserId");
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de la mise à jour de du statut.', 'start' => time()];
        }
    }
}
