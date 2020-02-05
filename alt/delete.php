<html>
 <head>
  <title>Delete Formular</title>
 </head>
<body>

<link type="text/css" href="inc/styles.css" rel="stylesheet">
<br>
<a href="index.phps" class="buttonweiss"><< zurück zur Hauptseite</a>
<br><br>
<?php

require_once('inc/config.inc.php');

$connection=mysql_connect($dbserver, $dbuser, $dbpass) or die ("Verbindungsversuch fehlgeschlagen");
mysql_select_db($dbname, $connection) or die("Konnte die Datenbank nicht waehlen.");

//Datensatz löschen
if($_GET['action'] == 'delete'){
	//SQL-Injections verhindern
	$id = mysql_escape_string($_GET['id']);
	$sql = "DELETE FROM markers WHERE id = {$id}";
	mysql_query($sql);
}

$sql = <<<SQL
SELECT 
	id, 
	name, 
	address,
    mobil, 
	tel, 
	mail, 
	www,
	lat,
	lng,
	type
FROM
	markers
ORDER BY 
    name;
SQL;

$adressen_query = mysql_query($sql) or die("Anfrage nicht erfolgreich");
$anzahl = mysql_num_rows($adressen_query);
echo "Anzahl der Datensätze: {$anzahl}";
?>

<table border="0" cellspacing="10" cellpadding="20">
	<tr>
        <th scope="col">Funktionen</th>
        <th scope="col">ID</th>
		<th scope="col">Name</th>
		<th scope="col">Adresse</th>
		<th scope="col">Mobil</th>
		<th scope="col">Tel</th>
		<th scope="col">mail</th>
		<th scope="col">www</th>
		<th scope="col">Lat</th>
		<th scope="col">Long</th>
		<th scope="col">Typ</th>
	</tr>
<?php
while ($adr = mysql_fetch_array($adressen_query)){
	echo <<<HTML
	<tr>
        <td><a href='?action=delete&id={$adr['id']}'>löschen</a></td>
        <td>{$adr['id']}</td>
		<td>{$adr['name']}</td>
		<td>{$adr['address']}</td>
		<td>{$adr['mobil']}</td>
		<td>{$adr['tel']}</td>
		<td>{$adr['mail']}</td>
		<td>{$adr['www']}</td>
		<td>{$adr['lat']}</td>
		<td>{$adr['lng']}</td>
		<td>{$adr['type']}</td>
	</tr>
HTML;
}
?>
</body>
</html>