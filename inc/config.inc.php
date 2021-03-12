<?php 

// Datenbankeinstellungen eintragen
$dbserver='localhost';
$dbuser='xxx_kontakt';
$dbpass='xxxkontakte';
$dbname='xxx_adressen';
$dbtab='markers';

$pdo = new PDO("mysql:host=$dbserver;dbname=$dbname;charset=utf8", $dbuser, $dbpass);

?>
