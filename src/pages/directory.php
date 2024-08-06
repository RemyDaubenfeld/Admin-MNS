<?php

require '../src/pages/libs/form-control.php';
require '../src/pages/libs/generate-password.php';

$title = 'Répertoire';

// PAGINATION
$search = $_GET['search'] ?? null;
$filterStatus = $_GET['status'] ?? null;

$queryStr = 'SELECT COUNT(*) AS nb_users FROM user 
             WHERE (user_firstname LIKE :search OR user_lastname LIKE :search)
             AND user_active = 1';
$params = ['search' => "%$search%"];

if ($filterStatus) {
    $queryStr .= ' AND user.status_id = :status_id';
    $params['status_id'] = $filterStatus;
}

$query = $dbh->prepare($queryStr);
$query->execute($params);
$nbUsers = $query->fetch();

$nbUsers = $nbUsers['nb_users'];
$usersPerPage = 19;
$numPage = !empty($_GET['num-page']) ? intval($_GET['num-page']) : 1;
$offset = ($numPage - 1) * $usersPerPage;
$totalPages = ceil($nbUsers / $usersPerPage);

$queryStr = 'SELECT * FROM user
            JOIN status ON user.status_id = status.status_id
            WHERE (user_firstname LIKE :search OR user_lastname LIKE :search)
            AND user_active = 1';
$params = ['search' => "%$search%"];

if ($filterStatus) {
    $queryStr .= ' AND user.status_id = :status_id';
    $params['status_id'] = $filterStatus;
}

$queryStr .= " ORDER BY user_lastname, user_firstname, user.status_id
               LIMIT $offset, $usersPerPage";

$query = $dbh->prepare($queryStr);
$query->execute($params);
$users = $query->fetchAll();

// RÉCUPÉRATION DES STATUTS
$query = $dbh->query('SELECT * FROM status WHERE status_active = 1');
$status = $query->fetchAll();

$filterStatusName = null;
foreach ($status as $istatus) {
    if ($istatus['status_id'] == $filterStatus) {
        $filterStatusName = $istatus['status_male_name'];
        break;
    }
}

// AJOUT UTILISATEUR
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser_hidden_submit'])) {
    $errors = 0;

    $firstnameData = firstnameCheck($_POST['firstname'] ?? null);
    $errors += $firstnameData['errors'];
    $firstname = $firstnameData['firstname'];

    $lastnameData = lastnameCheck($_POST['lastname'] ?? null);
    $errors += $lastnameData['errors'];
    $lastname = $lastnameData['lastname'];

    $genderData = genderCheck($_POST['gender'] ?? null);
    $errors += $genderData['errors'];
    $gender = $genderData['gender'];

    $mailData = mailCheck($_POST['mail'] ?? null);
    $errors += $mailData['errors'];
    $mail = $mailData['mail'];

    $phoneData = phoneCheck($_POST['phone'] ?? null);
    $errors += $phoneData['errors'];
    $phone = $phoneData['phone'];

    $addressData = addressCheck($_POST['addressNumber'] ?? null, $_POST['addressStreet'] ?? null, $_POST['addressZipCode'] ?? null, $_POST['addressCity'] ?? null);
    $errors += $addressData['errors'];
    $addressNumber = $addressData['addressNumber'];
    $addressStreet = $addressData['addressStreet'];
    $addressZipCode = $addressData['addressZipCode'];
    $addressCity = $addressData['addressCity'];

    $statusData = statusCheck($_POST['status'] ?? null);
    $errors += $statusData['errors'];
    $status = $statusData['status'];

    $password = generatePassword(16);

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

            $message = file_get_contents('../templates/mails/new-user.html.php');

            try {
                // CODE EN PROD  
                // mail($recipient, $subject, $message, $headers);
                // $_SESSION['modal_messages'][] = ['type' => 'success', 'message' => "Un mail a été envoyé à '$mail'.", 'start' => time()];
                // FIN DU CODE EN PROD

                // CODE EN LOCAL
                require '../templates/mails/new-user.html.php';
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