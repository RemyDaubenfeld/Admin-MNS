<?php

function firstnameCheck($firstname) {
    $errors = 0;

    if (empty($firstname)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le prénom est obligatoire.', 'start' => time()];
    } else {
        if (strlen($firstname) < 1 || strlen($firstname) > 50) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le prénom doit comporter entre 1 et 50 caractères.', 'start' => time()];
        }
    
        if (!preg_match("/^[a-zA-Zà-öÀ-Öø-ÿØ-ß' -]+$/i", $firstname)) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le prénom ne peux comporter que des lettres et les caractères spéciaux suivants ( \' , - ).', 'start' => time()];
        }

        $firstname = ucwords($firstname);
    }

    return ['errors' => $errors, 'firstname' => $firstname];
}

function lastnameCheck($lastname) {
    $errors = 0;

    if (empty($lastname)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom est obligatoire.', 'start' => time()];
    } else {
        if (strlen($lastname) < 1 || strlen($lastname) > 50) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom doit comporter entre 1 et 50 caractères.', 'start' => time()];
        }
    
        if (!preg_match("/^[a-zA-Zà-öÀ-Öø-ÿØ-ß' -]+$/i", $lastname)) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom ne peux comporter que des lettres et les caractères spéciaux suivants ( \' , - ).', 'start' => time()];
        }
    
        $lastname = mb_strtoupper($lastname, 'UTF-8');
    }

    return ['errors' => $errors, 'lastname' => $lastname];
}

function genderCheck($gender) {
    $errors = 0;

    if (!empty($gender)) {
        $genders = [1, 2, 3];
        if (!in_array($gender, $genders)){
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Ce genre est inconnu.', 'start' => time()];
        }

        if ($gender == 3) {
            $gender = null;
        }
    } 

    return ['errors' => $errors, 'gender' => $gender];
}

function mailCheck($mail) {
    global $dbh;
    global $currentUserMail;
    
    $errors = 0;

    if (empty($mail)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mail est obligatoire.', 'start' => time()];
    } else {
        if(strlen($mail) > 50) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'L\'adresse mail ne doit pas dépasser 50 caractères.', 'start' => time()];
        }

        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Cette adresse mail est invalide.', 'start' => time()];
        }
    
        // Test si l'mail est libre
        $query = $dbh->prepare('SELECT user_mail FROM user WHERE user_mail = :user_mail;');
        $query->execute(['user_mail' => $mail]);
        $existingMail = $query->fetch();
    
        if ($existingMail && $mail != $currentUserMail) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Cette adresse mail est déjà utilisé.', 'start' => time()];
        }
    
        $mail = strtolower($mail);
    }

    return ['errors' => $errors, 'mail' => $mail];
}

function phoneCheck($phone) {
    $errors = 0;

    if (!empty($phone)) {
        if (strlen($phone) < 9 || strlen($phone) > 17) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le numéro doit comporter entre 9 et 17 caractères.', 'start' => time()];
        }

        // Formatage du numéro
        $phone = preg_replace('/^(\+33|0)/', '', $phone);
        $phone = preg_replace('/[ .-]/', '', $phone);
        if (strlen($phone) == 9) {
            $phone = "0$phone";
        }

        if (!preg_match('/^0[1-9]\d{8}$/', $phone)) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le numéro est incorrect.', 'start' => time()];
        }
    }

    return ['errors' => $errors, 'phone' => $phone];
}

function addressCheck($addressNumber, $addressStreet, $addressZipCode, $addressCity) {
    $errors = 0;

    if (!empty($addressNumber) || !empty($addressStreet) || !empty($addressZipCode) || !empty($addressCity)) {
        if (empty($addressNumber)) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le numéro est obligatoire.', 'start' => time()];
        }

        if (empty($addressStreet)) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom de la rue est obligatoire.', 'start' => time()];
        }

        if (empty($addressZipCode)) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le code postal est obligatoire.', 'start' => time()];
        }

        if (empty($addressCity)) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom de la ville est obligatoire.', 'start' => time()];
        }
    }

    if (!empty($addressNumber) && !empty($addressStreet) && !empty($addressZipCode) && !empty($addressCity)) {
        if (strlen($addressNumber) < 1 || strlen($addressNumber) > 10) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le numéro doit comporter entre 1 et 10 caractères.', 'start' => time()];
        }
    
        if (strlen($addressStreet) < 1 || strlen($addressStreet) > 50) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom de la rue doit comporter entre 1 et 50 caractères.', 'start' => time()];
        }
    
        if (strlen($addressZipCode) != 5 || !ctype_digit($addressZipCode)) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le code postal doit comporter 5 chiffres.', 'start' => time()];
        }
    
        if (strlen($addressCity) < 1 || strlen($addressCity) > 10) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nom de la ville doit comporter entre 1 et 10 caractères.', 'start' => time()];
        }
    }

    return ['errors' => $errors, 'addressNumber' => $addressNumber, 'addressStreet' => $addressStreet, 'addressZipCode' => $addressZipCode, 'addressCity' => $addressCity];
}

function statusCheck($status) {
    global $dbh;

    $errors = 0;

    if (empty($status)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le statut est obligatoire.', 'start' => time()];
    } else {
        $query = $dbh->prepare('SELECT status_id FROM status WHERE status_id = :status_id');
        $query->execute(['status_id' => $status]);
        $existingStatus = $query->fetch();

        if (!$existingStatus) {
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Ce statut n\'existe pas.', 'start' => time()];
        }
    }

    return ['errors' => $errors, 'status' => $status];
}

function passwordCheck($newPassword, $confirmPassword) {
    $errors = 0;

    if (strlen($newPassword) < 8 || strlen($newPassword) > 40) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mot de passe doit comporter entre 8 et 40 caractères.', 'start' => time()];
    }

    if (!preg_match('/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', $newPassword)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mot de passe doit comporter entre 8 et 40 caractères et contenir au minimum une minuscule, une majuscule, un chiffre et un caractère spécial ( # , ? , ! , @ , $ , % , ^ , & , * , - ).', 'start' => time()];
    }

    if ($newPassword != $confirmPassword) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Les nouveaux mots de passe doivent être identique.', 'start' => time()];
    }

    return $errors;
}

function changePasswordCheck($oldPassword, $newPassword, $confirmPassword) {
    global $connectedUserPassword;
    $salt = "mns";

    $errors = 0;

    if (empty($oldPassword)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mot de passe actuel est obligatoire', 'start' => time()];
    }

    if (empty($newPassword)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nouveau mot de passe est obligatoire.', 'start' => time()];
    }

    if (empty($confirmPassword)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'La confirmation du mot de passe est obligatoire.', 'start' => time()];
    }

    if (!empty($oldPassword) && !empty($newPassword) && !empty($confirmPassword)){
        $errors += passwordCheck($newPassword, $confirmPassword);

        if (!password_verify($oldPassword.$salt, $connectedUserPassword)) {   
            $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le mot de passe actuel saisi est incorrect.', 'start' => time()];
        }
    }

    $newPassword = $newPassword.$salt;

    return ['errors' => $errors, 'password' => $newPassword];
}

function resetPasswordCheck($newPassword, $confirmPassword) {
    $salt = "mns";

    $errors = 0;

    if (empty($newPassword)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'Le nouveau mot de passe est obligatoire.', 'start' => time()];
    }

    if (empty($confirmPassword)) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'La confirmation du mot de passe est obligatoire.', 'start' => time()];
    }

    if (!empty($newPassword) && !empty($confirmPassword)){
        $errors += passwordCheck($newPassword, $confirmPassword);
    }

    $newPassword = $newPassword.$salt;

    return ['errors' => $errors, 'password' => $newPassword];
}

function isValidDate($dateString) {
    if (empty($dateString)) {
        return [false, 'La date est obligatoire.'];
    } else if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dateString )) {
        return [false, 'Cette date est incorrecte.'];
    } else {
        $date = DateTime::createFromFormat('Y-m-d', $dateString);
        $day = date('w', strtotime($dateString));

        if ($dateString != $date->format('Y-m-d')) {
            return [false, 'Cette date n\'existe pas.'];
        } else if ($day == 6 || $day == 0) {
            return [false, 'La date ne peux pas être pendant un week-end.'];
        } else {
            return [true];
        }
    }
}

function dateCheck($date) {
    $errors = 0;
    $validDate = isValidDate($date);

    if (!$validDate[0]) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => isValidDate($date)[1], 'start' => time()];
    }

    return ['errors' => $errors, 'date' => $date];
}

function isValidTime($timeString, $timeType = "heure") {
    $startMorning = 8 * 60 + 30; // 08:30
    $endMorning = 12 * 60; // 12:00
    $startAfternoon = 13 * 60 + 30; // 13:30
    $endAfternoon = 17 * 60; // 17:00

    if (empty($timeString)) {
        return [false, "L'$timeType est obligatoire."];
    } else if (!preg_match('/^\d{2}:\d{2}$/', $timeString )) {
        return [false, "L'$timeType est incorrecte."];
    } else {
        list($hours, $minutes) = explode(":", $timeString);
        $hours = intval($hours);
        $minutes = intval($minutes);
        $minutesTime = $hours * 60 + $minutes;

        if ($hours < 0 || $hours > 23 || $minutes < 0 || $minutes > 59) {
            return [false, "L'$timeType n'existe pas."];
        } else if (
            $minutesTime < $startMorning ||
            ($minutesTime > $endMorning && $minutesTime < $startAfternoon) ||
            $minutesTime > $endAfternoon
        ) {
            return [false, "L'$timeType ne peux pas être avant 08h30 ou après 17h00."];
        } else {
            return [true, $minutesTime];
        }
    }
}

function startTimeCheck($time) {
    $errors = 0;
    $validTime = isValidTime($time, "heure de départ");

    if (!$validTime[0]) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => $validTime[1], 'start' => time()];
    }

    return ['errors' => $errors, 'startTime' => $time];
}

function endTimeCheck($endTime, $startTime) {
    $errors = 0;
    $validEndTime = isValidTime($endTime, "heure de fin");
    $validStartTime = isValidTime($startTime, "heure de départ");

    if (!$validEndTime[0]) {
        $errors++;
        $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => $validEndTime[1], 'start' => time()];
    }

    if (!$validStartTime[0]) {
        $errors++;
    }

    if (($validEndTime[0] && $validStartTime[0]) && ($validEndTime[1] <= $validStartTime[1])) {
        $errors++;
            $_SESSION['modal_messages'][] = ['type' => 'error', 'message' => 'L\'heure de fin ne peux pas être avant l\'heure de départ.', 'start' => time()];

    }

    return ['errors' => $errors, 'endTime' => $endTime];
}