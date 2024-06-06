<?php

$query = $dbh->prepare("SELECT * FROM user 
                        JOIN status ON user.status_id = status.status_id
                        WHERE user_id = :user_id");
$query->execute(['user_id' => $_SESSION['user_id']]);
$user = $query->fetch();

$userId = $user['user_id'];
$userMail = $user['user_mail'];
$userPassword = $user['user_password'];
$userFirstname = $user['user_firstname'];
$userLastname = $user['user_lastname'];
$userFullName = "$userFirstname $userLastname";
$userInitials = strtoupper(substr($userFirstname, 0, 1) . substr($userLastname, 0, 1));
$userGender = $user['user_gender'];
$genders = [1 => 'Homme', 2 => 'Femme'];
$userGenderName = $genders[$userGender] ?? null;
$userPhone = $user['user_phone'];
$userAddressNumber = $user['user_address_number'];
$userStreet = $user['user_street'];
$userZipCode = $user['user_zip_code'];
$userCity = $user['user_city'];
$userCountry = $user['user_country'];
$userFullAdress = "$userAddressNumber $userStreet, $userZipCode $userCity, $userCountry";
$userImage = $user['user_image'];
$userStatusId = $user['status_id'];
$userStatus = $user['user_gender'] == 2 && !empty($user['status_female_name']) ? $user['status_female_name'] : $user['status_male_name'] ;
$userStaff = $user['status_staff'];

$query = $dbh->prepare("SELECT * FROM page 
                        JOIN page_status ON page.page_id = page_status.page_id
                        WHERE status_id = :status_id");
$query->execute(['status_id' => $user['status_id']]);
$userPages = $query->fetchAll();

$pagesWithoutRights = ['index', 'contact', 'account', 'user-details']; // 'user-details' a enlever dès que plus besoin
$userPagesAccess = $pagesWithoutRights;
$userPagesUpdate = $pagesWithoutRights;
$userPageAccess = in_array($page, $pagesWithoutRights);
$userPageUpdate = in_array($page, $pagesWithoutRights);

foreach ($userPages as $index => $userPage) {
    $userPagesAccess[] = $userPage['page_link'];
    if ($userPage['page_status_modification'] == 1) {
        $userPagesUpdate[] = $userPage['page_link'];
    }

    if ($userPage['page_link'] == $page) {
        $userPageAccess = true;
        if ($userPage['page_status_modification'] == 1) {
            $userPageUpdate = true;
        }
    }
}

// var_dump($userPagesAccess);
// exit;


// echo "Identifiant : ";
// var_dump($userId);
// echo "\nMail : ";
// var_dump($userMail);
// echo "\nMot de passe : ";
// var_dump($userPassword);
// echo "\nPrénom : ";
// var_dump($userFirstname);
// echo "\nNom : ";
// var_dump($userLastname);
// echo "\nNom complet : ";
// var_dump($userFullname);
// echo "\nGenre : ";
// var_dump($userGender);
// echo "\nTéléphone : ";
// var_dump($userPhone);
// echo "\nNuméro de rue : ";
// var_dump($userAddressNumber);
// echo "\nRue : ";
// var_dump($userStreet);
// echo "\nCode postal : ";
// var_dump($userZipCode);
// echo "\nVille : ";
// var_dump($userCity);
// echo "\nPays : ";
// var_dump($userCountry);
// echo "\nAdresse complète : ";
// var_dump($userFullAdress);
// echo "\nPhoto de profil : ";
// var_dump($userImage);
// echo "\nStatut : ";
// var_dump($userStatus);
// echo "\nPages accessibles : ";
// var_dump($userPages);
// echo "\nFait partit du staff : ";
// var_dump($userStaff);
// exit;
