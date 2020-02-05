<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
	<title>Kontakte</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
</html>
<body>

<link type="text/css" href="inc/styles.css" rel="stylesheet">

	<form action='index.php' method='POST'>
		<input type='text' size='10' maxlength='30' name='suchfeld'>
		<input type='submit' name='suche_enter' value='Suchen'>
	</form><div id="text_small_protokoll">Suchbegriff eingeben oder für alle Feld leer lassen</div><br>
	<hr>
	
	<?php
	
	// Config Datei einbinden
	require_once('inc/config.inc.php');
	
	
	if(isset($_POST['suche_enter'])) //wenn enter gedrückt wird
	{
		$con = @mysql_connect($dbserver, $dbuser, $dbpass) or die (mysql_error ());
		mysql_select_db($dbname) or die(mysql_error());
		$suchbegriff = trim(htmlentities(stripslashes(mysql_real_escape_string($_POST['suchfeld']))));
		
		// Prozentzeichen in der Variable $suchbegriff entfernen für exakte Suche
		$sql = "
		SELECT
			name,address,mobil,tel,mail,www,type,id
		FROM
			markers 
		WHERE 
			name LIKE '%$suchbegriff%' 
			or
			address LIKE '%$suchbegriff%'
			or
			mobil LIKE '%$suchbegriff%'
			or
			tel LIKE '%$suchbegriff%'
			or
			type LIKE '%$suchbegriff%'
			or
			mail LIKE '%$suchbegriff%'
			or
			www LIKE '%$suchbegriff%'
			or
			id LIKE '%$suchbegriff%'
		ORDER BY
			name,address,mobil,tel,mail,www,type,id
		";
		$query = mysql_query($sql);
		
		echo "<ul>";
		WHILE($row = mysql_fetch_assoc($query))
		{
			$name = $row['name'];
			$address = $row['address'];
			$mobil = $row['mobil'];
			$tel = $row['tel'];
			$type = $row['type'];
			$mail = $row['mail'];
			$www = $row['www'];
			
			$details = "<b>" . $row['name'] . ", </b>" .$row['address'] . " - " . $row['type'];
			$linktel1 = "<a href = 'tel:". $row['mobil'] ."'>" . $mobil . "</a>";
			$linktel2 = "<a href = 'tel:". $row['tel'] ."'>" . $tel . "</a>";
			$linkmail = "<a href = 'mailto:" . $row['mail'] ."'>" . $mail . "</a>";
			$linkweb = "<a href = '" . $row['www'] ."'>" . $www . "</a>";

			echo " <p class=\"bvh_liste\">" . $details . " - " . $linktel1 . " - " . $linktel2 . " - " . $linkmail . " - " . $linkweb ."</p> ";
		}
		echo "</ul>";
	}
	?>
	
	<hr><br>
	<a href="map.php" class="buttonweiss">Google Map</a><br><br>
	<a href="eintragen.php" class="buttonweiss">Neue Adresse eintragen</a><br><br>
	<a href="delete.php" class="buttonadmin">Adresse(n) löschen</a><br><br>

</body>