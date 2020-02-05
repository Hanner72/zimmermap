<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
	<title>Kontakte eintragen</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>
</html>
<body>

<link type="text/css" href="inc/styles.css" rel="stylesheet">

key=AIzaSyAUKiRWWU2Iz8EBxuRt6lCAdJ7J5zL0nww

<style type="text/css">
.iframed{
position:absolute;
top:-833px;left:-5px
}
.iframeholder{
width:220px;
}
.iframeholder div{
position:relative;
width:220px;
height:2000px;
overflow:auto;
}

a.tooltip {
  position: relative;
  text-decoration: none;
  white-space: pre-line;
}
a.tooltip:after {
  content: attr(data-tooltip);
  position: absolute;
  bottom: 130%;
  left: 0%;
  background: #ffcb66;
  padding: 5px 15px;
  color: black;
  -webkit-border-radius: 10px;
  -moz-border-radius : 10px;
  border-radius : 10px;
  white-space: nowrap;
  opacity: 0;
  -webkit-transition: all 0.4s ease;
  -moz-transition : all 0.4s ease;
  transition : all 0.4s ease;
  white-space: pre-line;
}
a.tooltip:before {
  content: "";
  position: absolute;
  width: 0;
  height: 0;
  border-top: 20px solid #ffcb66;
  border-left: 20px solid transparent;
  border-right: 20px solid transparent;
  -webkit-transition: all 0.4s ease;
  -moz-transition : all 0.4s ease;
  transition : all 0.4s ease;
  opacity: 0;
  left: 30%;
  bottom: 90%;
  white-space: pre-line;
}
a.tooltip:hover:after {
  bottom: 100%;
  white-space: pre-line;
}
a.tooltip:hover:before {
  bottom: 70%;
  white-space: pre-line;
}
a.tooltip:hover:after, a:hover:before {
  opacity: 1;
  white-space: pre-line;
}
.tooltip {
  white-space: pre-line;
}

</style>

<iframe src="https://www.barattalo.it/convert-address-lat-long" scrolling="no" width="600" height="1400" class="iframed"></iframe>
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

<a href="#" class="tooltip" data-tooltip="Für einen neuen Eintrag muss zuerst der Längen- und Breitengrad ermittelt werden.
Also hier bitte ganz oben die Adresse wie folgt eingeben und auf 'Go There' klicken:
 Adresse Hausnummer, PLZ Ort
 Jetzt kann in der Karte überprüft werden ob die Position stimmt, wenn ja, 'Lat' und 'Long' unten in Tabelle eintragen." data-html="true">
 ^------^ Beschreibung für neuen Eintrag. ^------^
</a>

<?php

//Formular zur Dateneingabe
echo'<h3>Daten eintragen</h3>

<form method="post" action="datenbank01.php">
  Name: <input type="text" name="name" size="60"><br>
  Adresse: <input type="text" name="address" size="80"><br>
  Mobil: <input type="text" name="mobil" size="30"><br>
  Festnetz: <input type="text" name="tel" size="30"><br>
  Mail: <input type="email" name="mail" size="60"><br>
  Web: <input type="url" name="www" size="60" value="http://"><br>
  Lat: <input type="text" name="lat" size="30"><br>
  Long: <input type="text" name="lng" size="30"><br>
  <label>Typ:
    <select name="type" size="1">
      <option>Hotel</option>
      <option>Gasthaus</option>
      <option>Privat</option>
    </select>
  </label>
  <input type="submit" value="Eintragen!">
</form>';

?>
<hr><br>
	<a href="map.php" class="buttonweiss">Google Map</a><br><br>
	<a href="delete.php" class="buttonadmin">Adresse(n) löschen</a><br><br>
	<a href="index.php" class="buttonweiss"><< zurück zur Hauptseite</a>

</body>