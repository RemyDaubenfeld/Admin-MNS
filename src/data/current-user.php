<?php

$query = $dbh->prepare("SELECT * FROM user
                        JOIN status ON user.status_id = status.status_id
                        WHERE user_id = :user_id");
$query->execute(['user_id' => $_GET['user-id']]);
$user = $query->fetch();

$currentUserId = $user['user_id'];
$currentUserMail = $user['user_mail'];
$currentUserFirstname = $user['user_firstname'];
$currentUserLastname = $user['user_lastname'];
$currentUserFullName = "$currentUserFirstname $currentUserLastname";
$currentUserInitials = strtoupper(substr($currentUserFirstname, 0, 1) . substr($currentUserLastname, 0, 1));
$currentUserGender = $user['user_gender'];
$genders = [1 => 'Homme', 2 => 'Femme'];
$currentUserGenderName = $genders[$currentUserGender] ?? null;
$currentUserPhone = $user['user_phone'];
$currentUserAddressNumber = $user['user_address_number'];
$currentUserStreet = $user['user_street'];
$currentUserZipCode = $user['user_zip_code'];
$currentUserCity = $user['user_city'];
$currentUserFullAdress = $currentUserAddressNumber && $currentUserStreet && $currentUserZipCode && $currentUserCity ? "$currentUserAddressNumber $currentUserStreet, $currentUserZipCode $currentUserCity" : null;
$currentUserImage = $user['user_image'];
$currentUserStatus= $user['user_gender'] == 2 && !empty($user['status_female_name']) ? $user['status_female_name'] : $user['status_male_name'] ;
$currentUserStaff = $user['status_staff'];