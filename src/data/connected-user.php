<?php

$query = $dbh->prepare("SELECT * FROM user 
                        JOIN status ON user.status_id = status.status_id
                        WHERE user_id = :user_id");
$query->execute(['user_id' => $_SESSION['user_id']]);
$user = $query->fetch();

$connectedUserId = $user['user_id'];
$connectedUserMail = $user['user_mail'];
$connectedUserPassword = $user['user_password'];
$connectedUserFirstname = $user['user_firstname'];
$connectedUserLastname = $user['user_lastname'];
$connectedUserFullName = "$connectedUserFirstname $connectedUserLastname";
$connectedUserInitials = strtoupper(substr($connectedUserFirstname, 0, 1) . substr($connectedUserLastname, 0, 1));
$connectedUserGender = $user['user_gender'];
$genders = [1 => 'Homme', 2 => 'Femme'];
$connectedUserGenderName = $genders[$connectedUserGender] ?? null;
$connectedUserPhone = $user['user_phone'];
$connectedUserAddressNumber = $user['user_address_number'];
$connectedUserStreet = $user['user_street'];
$connectedUserZipCode = $user['user_zip_code'];
$connectedUserCity = $user['user_city'];
$connectedUserFullAdress = $connectedUserAddressNumber && $connectedUserStreet && $connectedUserZipCode && $connectedUserCity ? "$connectedUserAddressNumber $connectedUserStreet, $connectedUserZipCode $connectedUserCity" : null;
$connectedUserImage = $user['user_image'];
$connectedUserStatusId = $user['status_id'];
$connectedUserStatus = $user['user_gender'] == 2 && !empty($user['status_female_name']) ? $user['status_female_name'] : $user['status_male_name'] ;
$connectedUserStaff = $user['status_staff'];

$query = $dbh->prepare('SELECT * FROM page 
                        JOIN page_status ON page.page_id = page_status.page_id
                        WHERE status_id = :status_id');
$query->execute(['status_id' => $user['status_id']]);
$connectedUserPages = $query->fetchAll();

$pagesWithoutRights = ['index', 'contact', 'account', 'user-details']; // 'user-details' a enlever dès que plus besoin
$connectedUserPagesAccess = $pagesWithoutRights;
$connectedUserPagesUpdate = $pagesWithoutRights;
$connectedUserPageAccess = in_array($page, $pagesWithoutRights);
$connectedUserPageUpdate = in_array($page, $pagesWithoutRights);

foreach ($connectedUserPages as $index => $connectedUserPage) {
    $connectedUserPagesAccess[] = $connectedUserPage['page_link'];
    if ($connectedUserPage['page_status_modification'] == 1) {
        $connectedUserPagesUpdate[] = $connectedUserPage['page_link'];
    }

    if ($connectedUserPage['page_link'] == $page) {
        $connectedUserPageAccess = true;
        if ($connectedUserPage['page_status_modification'] == 1) {
            $connectedUserPageUpdate = true;
        }
    }
}