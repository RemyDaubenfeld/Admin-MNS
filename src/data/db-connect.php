<?php

$host = 'localhost';
$dbname = 'admax';
$user = 'root';
$pwd = '';

try
{
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
catch (PDOException $e)
{
    echo "Error: " . $e->getMessage();
}