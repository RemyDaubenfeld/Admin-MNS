<?php

if (!empty($_SESSION['user_id'])) {
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
    $userFullname = "$userFirstname $userLastname";
    $userGender = $user['user_gender'];
    $userPhone = $user['user_phone'];
    $userAddressNumber = $user['user_address_number'];
    $userStreet = $user['user_street'];
    $userZipCode = $user['user_zip_code'];
    $userCity = $user['user_city'];
    $userCountry = $user['user_country'];
    $userFullAdress = "$userAddressNumber $userStreet, $userZipCode $userCity, $userCountry";
    $userImage = $user['user_image'];
    $userStatus= $user['status_id'] == 1 && !empty($user['status_female_name']) ? $user['status_female_name'] : $user['status_male_name'] ;
    $userStaff = $user['status_staff'];

    $query = $dbh->prepare("SELECT * FROM page 
                            JOIN page_status ON page.page_id = page_status.page_id
                            WHERE status_id = :status_id");
    $query->execute(['status_id' => $user['status_id']]);
    $userPages = $query->fetchAll();

    foreach ($userPages as $index => $userPage) {
        if ($userPage['page_name'] == 'Documents') {
            $userPages[$index]['page_link'] = 'files';
        } else if ($userPage['page_name'] == 'Planning') {
            $userPages[$index]['page_link'] = 'planning';
        } else {
            $userPages[$index]['page_link'] = $userPages[$index]['page_name'];
        }
    }
    
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
}