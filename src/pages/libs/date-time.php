<?php 

setlocale(LC_TIME, 'fr_FR');
date_default_timezone_set('Europe/Paris');

$now = date('Y-m-d H:i:s');
$nowDateTime = new DateTime();

$week_start = date('Y-m-d H:i:s', strtotime('last monday', strtotime($now)));
$week_end = date('Y-m-d H:i:s', strtotime('next sunday', strtotime($now)));

$Dateformatter = new IntlDateFormatter(
    'fr_FR',
    IntlDateFormatter::FULL,
    IntlDateFormatter::NONE,
    'Europe/Paris',
    IntlDateFormatter::GREGORIAN,
    'EEEE d MMMM yyyy'
);



