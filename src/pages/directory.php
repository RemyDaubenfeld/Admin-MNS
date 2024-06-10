<?php

$title = 'Répertoire';

$query = $dbh->query("SELECT * FROM user JOIN status ON user.status_id = status.status_id WHERE user_active = 1 ORDER BY user_lastname, user_firstname, user.status_id");
$users = $query->fetchAll();

// AJOUT UTILISATEUR
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser_hidden_submit'])) {
    $errors = 0;

    // Prénom
    if (empty($_POST['firstname'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le prénom est obligatoire.', 'start' => time()];
    } else {
        $firstname = $_POST['firstname'];
    }

    if(strlen($firstname) < 1 || strlen($firstname) > 50) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le prénom doit comporter entre 1 et 50 caractères.', 'start' => time()];
    }

    if(!preg_match("/^[a-zà-öø-ÿ' -]+$/i", $firstname)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le prénom ne peux comporter que des lettres et les caractères spéciaux suivants ( \' , - ).', 'start' => time()];
    }

    $firstname = ucwords($firstname);

    // Nom
    if (empty($_POST['lastname'])) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom est obligatoire.', 'start' => time()];
    } else {
        $lastname = $_POST['lastname'];
    }

    if(strlen($lastname) < 1 || strlen($lastname) > 50) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom doit comporter entre 1 et 50 caractères.', 'start' => time()];
    }

    if(!preg_match("/^[a-zà-öø-ÿ' -]+$/i", $lastname)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom ne peux comporter que des lettres et les caractères spéciaux suivants ( \' , - ).', 'start' => time()];
    }

    $lastname = mb_strtoupper($lastname, 'UTF-8');

    // Genre
    if(!empty($_POST['gender']) && $_POST['gender'] != 1 && $_POST['gender'] != 2 && $_POST['gender'] != 3) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Ce genre est inconnu.', 'start' => time()];
    } else {
        if (empty($_POST['gender']) || $_POST['gender'] == 3){
            $gender = null;
        } else {
            $gender = $_POST['gender'];
        }
    }

    // Mail
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

    // Téléphone
    if(!empty($_POST['phone'])) {
        $phone = $_POST['phone'];

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
    } else {
        $phone = null;
    }

    // Adresse
    if (!empty($_POST['addressNumber']) || !empty($_POST['addressStreet']) || !empty($_POST['addressZipCode']) || !empty($_POST['addressCity'])) {
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
    } else {
        $addressNumber = null;
        $addressStreet = null;
        $addressZipCode = null;
        $addressCity = null;
    }

    if($addressNumber != null && (strlen($addressNumber) < 1 || strlen($addressNumber) > 10)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le numéro doit comporter entre 1 et 10 caractères.', 'start' => time()];
    }

    if($addressStreet != null && (strlen($addressStreet) < 1 || strlen($addressStreet) > 50)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom de la rue doit comporter entre 1 et 50 caractères.', 'start' => time()];
    }

    if($addressZipCode != null && (strlen($addressZipCode) != 5 || !ctype_digit($addressZipCode))) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le code postal doit comporter 5 chiffres.', 'start' => time()];
    }

    if($addressCity != null && (strlen($addressCity) < 1 || strlen($addressCity) > 10)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom de la ville doit comporter entre 1 et 10 caractères.', 'start' => time()];
    }

    // Status
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

    // Mot de passe
    $passwordLength = 16;
    $salt = "mns";

    $lowercase = 'abcdefghijklmnopqrstuvwxyz';
    $uppercase = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $specialChars = '#?!@$%^&*-';
    $allChars = $lowercase . $uppercase . $numbers . $specialChars;

    $passwordChars = [];
    while (count($passwordChars) < $passwordLength ) {
        $newLowercase = '';
        while (empty($newLowercase) || in_array($newLowercase, $passwordChars)) {
            $newLowercase = $lowercase[random_int(0, strlen($lowercase) - 1)];
        }
        $passwordChars[] = $newLowercase;

        $newUppercase = '';
        while (empty($newUppercase) || in_array($newUppercase, $passwordChars)) {
            $newUppercase = $uppercase[random_int(0, strlen($uppercase) - 1)];
        }
        $passwordChars[] = $newUppercase;
        
        $newSpecialChars = '';
        while (empty($newSpecialChars) || in_array($newSpecialChars, $passwordChars)) {
            $newSpecialChars = $specialChars[random_int(0, strlen($specialChars) - 1)];
        }
        $passwordChars[] = $newSpecialChars;
    }
    shuffle($passwordChars);
    $password = implode('', $passwordChars);
    $passwordWithSalt = $password . $salt;

    if(empty($errors)){
        $query = $dbh->prepare('INSERT INTO user 
                                (user_lastname, user_firstname, user_gender, user_mail, user_password, user_phone, user_address_number, user_street, user_zip_code, user_city, user_active, status_id)
                                VALUES (:user_lastname, :user_firstname, :user_gender, :user_mail, :user_password, :user_phone, :user_address_number, :user_street, :user_zip_code, :user_city, 1, :status_id)');
        $query->execute([
            'user_lastname' => $lastname,
            'user_firstname' => $firstname,
            'user_gender' => $gender,
            'user_mail' => $mail,
            'user_password' => password_hash($password, PASSWORD_DEFAULT),
            'user_phone' => $phone,
            'user_address_number' => $addressNumber,
            'user_street' => $addressStreet,
            'user_zip_code' => $addressZipCode,
            'user_city' => $addressCity,
            'status_id' => $status
        ]);

        if($query) {
            $token = bin2hex(random_bytes(32));

            $query = $dbh->prepare('SELECT user_token FROM user WHERE user_token = :user_token');
            $query->execute(['user_token' => $token]);
            $existingToken = $query->fetch();

            do {
                $token = bin2hex(random_bytes(32));

                $query = $dbh->prepare('SELECT user_token FROM user WHERE user_token = :user_token');
                $query->execute(['user_token' => $token]);
                $existingToken = $query->fetch();
            } while ($existingToken);

            $query = $dbh->prepare('UPDATE user SET user_token = :user_token, user_token_valid = :user_token_valid WHERE user_id = :user_id AND user_active = 0');
            $query->execute([
                'user_token' => $token,
                'user_token_valid' => date('Y-m-d H:i:s'),
                'user_id' => $user['user_id']
            ]);
            
            // Envoi du mail
            $recipient = $mail;

            $headers = 'MIME-Version: 1.0\r\n'.
            'Content-type:text/html;charset=UTF-8\r\n'.
            'From: no-reply@admax.website\r\n'.
            'Reply-To: no-reply@admax.website\r\n'.
            'X-Mailer: PHP/' . phpversion();

            $subject = 'Admax - Votre compte a été créé';

            $expiry = new DateTime();
            $expiry->modify('+1 hour');

            $message = file_get_contents('../templates/new-user-mail.html.php');

            try {
                // CODE EN PROD  
                // mail($recipient, $subject, $message, $headers);
                // $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Un mail a été envoyé à '$email'.", 'start' => time()];
                // FIN DU CODE EN PROD

                // CODE EN LOCAL
                require '../templates/new-user-mail.html.php';
                exit;
                // FIN DU CODE EN LOCAL
            } catch (Exception $e) {
                $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'L\'envoi de l\'e-mail a échoué.', 'start' => time()];
            }

            $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => 'L\'utilisateur a été ajouté avec succès.', 'start' => time()];
            header('Location: /?page=directory');
            exit;
        } else {
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Une erreur s\'est produite lors de l\'ajout de l\'utilisateur.', 'start' => time()];
        }
    }
} 