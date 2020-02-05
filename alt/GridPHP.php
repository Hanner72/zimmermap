<?php
include("inc/configjsgrid.inc.php");

$page = $_REQUEST["page"];
$limit = $_REQUEST["rows"];
$sidx = $_REQUEST["sidx"];
$sord = $_REQUEST["sord"];

if (!$sidx) $sidx = 1;

$totalrows = isset($_REQUEST["totalrows"]) ? $_REQUEST["totalrows"]: false;

if($totalrows) {

    $limit = $totalrows;

}


$db =mysql_connect($dbserver, $dbuser, $dbpass, $dbname) or die ("Connection Error: " . mysql_error($db));

mysql_select_db($db,$dbname) or die ("Error connecting to db!");
$result = mysql_query($db,"SELECT COUNT(*) AS count FROM film");
$row = mysql_fetch_array($result,MYSQLI_ASSOC);
$count = $row['count'];

if ($count > 0 ) {

    $var = @($count/$limit);
    $totalpages = ceil ($var);

} else {

    $totalpages = 0;

}

if ($page > $totalpages) $page=$totalpages;

if ($limit < 0) $limit = 0;

$start = $limit*$page - $limit;
if ($start < 0) $start = 0;

$sql = "SELECT film_id, title, description, length, rating FROM film ORDER BY $sidx $sord LIMIT $start , $limit";
$result = mysql_query($db,$sql) or die ("Couldn't execute query! ".mysql_error($db));

$responce = new \stdClass();
$responce -> success = false;
$responce -> page = $page;
$responce -> total = $totalpages;
$responce -> records = $count;

$i = 0;
while($row = mysql_fetch_array($result, MYSQLI_ASSOC)) {

    $responce -> rows[$i]["id"] = $row["film_id"];
    $responce -> rows[$i]['cell'] = array($row["film_id"],$row["title"],$row["description"],$row["length"],$row["rating"]);
    $i++;

}

echo json_encode($responce);
mysql_close($db);

?>