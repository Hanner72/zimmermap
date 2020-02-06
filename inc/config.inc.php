<?php 

// Datenbankeinstellungen eintragen
$dbserver='localhost';
$dbuser='strabags_kontakt';
$dbpass='strabagkontakte';
$dbname='strabags_adressen';
$dbtab='markers';

$pdo = new PDO("mysql:host=$dbserver;dbname=$dbname;charset=utf8", $dbuser, $dbpass);

?>