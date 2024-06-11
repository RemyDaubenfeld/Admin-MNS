<?php

function generateToken($userId) {
    global $dbh;

    $existingToken = true;
    do {
        $token = bin2hex(random_bytes(32));

        $query = $dbh->prepare('SELECT user_token FROM user WHERE user_token = :user_token');
        $query->execute(['user_token' => $token]);
        $existingToken = $query->fetch();
    } while ($existingToken);

    $query = $dbh->prepare('UPDATE user SET user_token = :user_token, user_token_valid = :user_token_valid WHERE user_id = :user_id');
    $query->execute([
        'user_token' => $token,
        'user_token_valid' => date('Y-m-d H:i:s'),
        'user_id' => $userId
    ]);

    return $token;
}