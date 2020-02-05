<?php
require("inc/config.inc.php");

function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Opens a connection to a MySQL server
$connection=mysql_connect ("localhost", $dbuser, $dbpass);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($dbname, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}

// Select all the rows in the markers table
$query = "SELECT * FROM markers WHERE 1";
$result = mysql_query($query);
if (!$result) {
  die('Invalid query: ' . mysql_error());
}

header("Content-type: text/xml");

// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind=0;
// Iterate through the rows, printing XML nodes for each
while ($row = @mysql_fetch_assoc($result)){
  // Add to XML document node
  echo '<marker ';
  echo 'id="' . $row['id'] . '" ';
  echo 'voller_name="' . parseToXML($row['voller_name']) . '" ';
  echo 'addresse="' . parseToXML($row['addresse']) . '" ';
  echo 'mobil="' . parseToXML($row['mobil']) . '" ';
  echo 'tel="' . parseToXML($row['tel']) . '" ';
  echo 'mail="' . parseToXML($row['mail']) . '" ';
  echo 'www="' . parseToXML($row['www']) . '" ';
  echo 'lat="' . parseToXML($row['lat']) . '" ';
  echo 'lng="' . parseToXML($row['lng']) . '" ';
  echo 'kategorie="' . $row['kategorie'] . '" ';
  echo '/>';
  $ind = $ind + 1;
}

// End XML file
echo '</markers>';

?>