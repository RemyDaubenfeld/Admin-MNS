<?php

function generatePassword($passwordLength) {
    $salt = "mns";

    $lowercases = 'abcdefghijklmnopqrstuvwxyz';
    $uppercases = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';
    $specialChars = '#?!@$%^&*-';

    $passwordChars = [];
    while (count($passwordChars) < $passwordLength ) {
        $newLowercase = '';
        while (empty($newLowercase) || in_array($newLowercase, $passwordChars)) {
            $newLowercase = $lowercases[random_int(0, strlen($lowercases) - 1)];
        }
        $passwordChars[] = $newLowercase;

        $newUppercase = '';
        while (empty($newUppercase) || in_array($newUppercase, $passwordChars)) {
            $newUppercase = $uppercases[random_int(0, strlen($uppercases) - 1)];
        }
        $passwordChars[] = $newUppercase;

        $newNumber = '';
        while (empty($newNumber) || in_array($newNumber, $passwordChars)) {
            $newNumber = $numbers[random_int(0, strlen($numbers) - 1)];
        }
        $passwordChars[] = $newNumber;
        
        $newSpecialChar = '';
        while (empty($newSpecialChar) || in_array($newSpecialChar, $passwordChars)) {
            $newSpecialChar = $specialChars[random_int(0, strlen($specialChars) - 1)];
        }
        $passwordChars[] = $newSpecialChar;
    }

    shuffle($passwordChars);

    $password = implode('', $passwordChars);
    $password = substr($password, 0, $passwordLength);

    $passwordWithSalt = $password . $salt;

    return $passwordWithSalt;
}