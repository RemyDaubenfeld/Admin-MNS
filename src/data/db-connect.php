<?php

$host = '193.203.168.44';
$dbname = 'u675771680_admax';
$user = 'u675771680_adminadmax';
$pwd = 'FilRougeAdmax2024';

try
{
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
catch (PDOException $e)
{
    echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
    exit;
}