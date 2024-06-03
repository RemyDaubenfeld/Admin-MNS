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
            $userPages[$index]['page_icone_viewBox'] = '0 0 384 512';
            $userPages[$index]['page_icone_path'] = 'M0 64C0 28.7 28.7 0 64 0H224V128c0 17.7 14.3 32 32 32H384V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V64zm384 64H256V0L384 128z';
        } else if ($userPage['page_name'] == 'Planning') {
            $userPages[$index]['page_link'] = 'planning';
            $userPages[$index]['page_icone_viewBox'] = '0 0 448 512';
            $userPages[$index]['page_icone_path'] = 'M96 32V64H48C21.5 64 0 85.5 0 112v48H448V112c0-26.5-21.5-48-48-48H352V32c0-17.7-14.3-32-32-32s-32 14.3-32 32V64H160V32c0-17.7-14.3-32-32-32S96 14.3 96 32zM448 192H0V464c0 26.5 21.5 48 48 48H400c26.5 0 48-21.5 48-48V192z';
        } else if ($userPage['page_name'] == 'Retards') {
            $userPages[$index]['page_link'] = 'lateness';
            $userPages[$index]['page_icone_viewBox'] = '0 0 512 512';
            $userPages[$index]['page_icone_path'] = 'M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z';
        } else if ($userPage['page_name'] == 'Absences') {
            $userPages[$index]['page_link'] = 'absences';
            $userPages[$index]['page_icone_viewBox'] = '0 0 448 512';
            $userPages[$index]['page_icone_path'] = 'M128 0c17.7 0 32 14.3 32 32V64H288V32c0-17.7 14.3-32 32-32s32 14.3 32 32V64h48c26.5 0 48 21.5 48 48v48H0V112C0 85.5 21.5 64 48 64H96V32c0-17.7 14.3-32 32-32zM0 192H448V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V192zM305 305c9.4-9.4 9.4-24.6 0-33.9s-24.6-9.4-33.9 0l-47 47-47-47c-9.4-9.4-24.6-9.4-33.9 0s-9.4 24.6 0 33.9l47 47-47 47c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l47-47 47 47c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-47-47 47-47z';
        } else if ($userPage['page_name'] == 'Inscriptions') {
            $userPages[$index]['page_link'] = 'registrations';
            $userPages[$index]['page_icone_viewBox'] = '0 0 384 512';
            $userPages[$index]['page_icone_path'] = 'M64 0C28.7 0 0 28.7 0 64V448c0 35.3 28.7 64 64 64H320c35.3 0 64-28.7 64-64V160H256c-17.7 0-32-14.3-32-32V0H64zM256 0V128H384L256 0zM112 256H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16zm0 64H272c8.8 0 16 7.2 16 16s-7.2 16-16 16H112c-8.8 0-16-7.2-16-16s7.2-16 16-16z';
        } else if ($userPage['page_name'] == 'Répertoire') {
            $userPages[$index]['page_link'] = 'directory';
            $userPages[$index]['page_icone_viewBox'] = '0 0 512 512';
            $userPages[$index]['page_icone_path'] = 'M96 0C60.7 0 32 28.7 32 64V448c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V64c0-35.3-28.7-64-64-64H96zM208 288h64c44.2 0 80 35.8 80 80c0 8.8-7.2 16-16 16H144c-8.8 0-16-7.2-16-16c0-44.2 35.8-80 80-80zm-32-96a64 64 0 1 1 128 0 64 64 0 1 1 -128 0zM512 80c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V80zM496 192c-8.8 0-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm16 144c0-8.8-7.2-16-16-16s-16 7.2-16 16v64c0 8.8 7.2 16 16 16s16-7.2 16-16V336z';
        } else if ($userPage['page_name'] == 'Formations') {
            $userPages[$index]['page_link'] = 'formations';
            $userPages[$index]['page_icone_viewBox'] = '0 0 640 512';
            $userPages[$index]['page_icone_path'] = 'M320 32c-8.1 0-16.1 1.4-23.7 4.1L15.8 137.4C6.3 140.9 0 149.9 0 160s6.3 19.1 15.8 22.6l57.9 20.9C57.3 229.3 48 259.8 48 291.9v28.1c0 28.4-10.8 57.7-22.3 80.8c-6.5 13-13.9 25.8-22.5 37.6C0 442.7-.9 448.3 .9 453.4s6 8.9 11.2 10.2l64 16c4.2 1.1 8.7 .3 12.4-2s6.3-6.1 7.1-10.4c8.6-42.8 4.3-81.2-2.1-108.7C90.3 344.3 86 329.8 80 316.5V291.9c0-30.2 10.2-58.7 27.9-81.5c12.9-15.5 29.6-28 49.2-35.7l157-61.7c8.2-3.2 17.5 .8 20.7 9s-.8 17.5-9 20.7l-157 61.7c-12.4 4.9-23.3 12.4-32.2 21.6l159.6 57.6c7.6 2.7 15.6 4.1 23.7 4.1s16.1-1.4 23.7-4.1L624.2 182.6c9.5-3.4 15.8-12.5 15.8-22.6s-6.3-19.1-15.8-22.6L343.7 36.1C336.1 33.4 328.1 32 320 32zM128 408c0 35.3 86 72 192 72s192-36.7 192-72L496.7 262.6 354.5 314c-11.1 4-22.8 6-34.5 6s-23.5-2-34.5-6L143.3 262.6 128 408z';
        } else {
            $userPages[$index]['page_link'] = $userPages[$index]['page_name'];
            $userPages[$index]['page_icone_viewBox'] = '0 0 512 512';
            $userPages[$index]['page_icone_path'] = 'M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-384c13.3 0 24 10.7 24 24V264c0 13.3-10.7 24-24 24s-24-10.7-24-24V152c0-13.3 10.7-24 24-24zM224 352a32 32 0 1 1 64 0 32 32 0 1 1 -64 0z';
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