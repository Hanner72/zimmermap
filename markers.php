<?php

require("inc/config.inc.php");

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

// hier die richtige Datei einziehen
// require_once '../../connect.php';

function parseToXML($htmlStr)
{
    $xmlStr = str_replace('<', '&lt;', $htmlStr);
    $xmlStr = str_replace('>', '&gt;', $xmlStr);
    $xmlStr = str_replace('"', '&quot;', $xmlStr);
    $xmlStr = str_replace("'", '&#39;', $xmlStr);
    $xmlStr = str_replace("&", '&amp;', $xmlStr);
    return $xmlStr;
}

$connect = new PDO("mysql:host=$dbserver;dbname=$dbname;charset=utf8", $dbuser, $dbpass);

$query = "SELECT * FROM markers";

$statement = $connect->prepare($query);
$statement->execute();
// var_dump($statement->errorInfo());
$result = $statement->fetchAll();

header("Content-type: text/xml");
// Start XML file, echo parent node
echo "<?xml version='1.0' ?>";
echo '<markers>';
$ind = 0;
// Iterate through the rows, printing XML nodes for each
foreach ($result as $row) {
//var_dump($row);
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
