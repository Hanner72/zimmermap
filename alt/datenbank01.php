<?php

require_once('inc/config.inc.php');

//Variablen zuweisen
$name = $_POST["name"];
$address = $_POST["address"];
$mobil = $_POST["mobil"];
$tel = $_POST["tel"];
$mail = $_POST["mail"];
$www = $_POST["www"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];
$type = $_POST["type"];

if (($name == "") OR ($address == "") OR ($lat == "") OR ($lng == "")) {
        echo "Fehler: Eintrag unvollständig.";
        die; 
}

//Verbindung herstellen
$datenbank = mysql_connect($dbserver, $dbuser, $dbpass) or die ("Verbindung fehlgeschlagen: ".mysql_error());
$verbunden = mysql_select_db($dbname) or die ("Datenbank nicht gefunden oder fehlerhaft");

//Daten in DB speichern
$sql_befehl = mysql_query("INSERT INTO markers (name,address,mobil,tel,mail,www,lat,lng,type) VALUES 
('".$_POST['name']."',
'".$_POST['address']."',
'".$_POST['mobil']."',
'".$_POST['tel']."',
'".$_POST['mail']."',
'".$_POST['www']."',
'".$_POST['lat']."',
'".$_POST['lng']."',
'".$_POST['type']."'
)");

if($sql_befehl)
{ echo "Ihr Eintrag wurde hinzugefügt. <a href=\"index.php\">..zurück</a>"; }

//Verbindung beenden
mysql_close($datenbank); 

?>