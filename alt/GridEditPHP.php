<?php
include("inc/configjsgrid.inc.php");

$db = mysql_connect($dbserver, $dbuser, $dbpass, $dbname) or die ("Connection Error: " . mysql_error($db));
mysql_select_db($db,$dbname) or die ("Error connecting to db.");

$filmid = $_POST["film_id"];
$title = $_POST["title"];
$description = $_POST["description"];
$length = $_POST["length"];
$rating = $_POST["rating"];

//switch($_REQUEST["oper"]) {
//
//  case "add":
//      $sql = "INSERT INTO film (film_id,title,description,length,rating) VALUES ($filmid,$title,$description,$length,$rating)";
//      mysqli_query($db, $sql);
//  break;
//  
//  case "edit":
//      $sql = "UPDATE film SET film_id=$filmid, title=$title, description=$description, length=$length, rating=$rating";
//      mysqli_query($db, $sql);
//  break;
//  
//  case "del":
//      $sql = "DELETE FROM film";
//      mysqli_query($db, $sql);
//  break;
echo "TEST!!!";
if($_REQUEST["oper"]=='add') {

    $sql = "INSERT INTO film (film_id,title,description,length,rating) VALUES ($filmid,$title,$description,$length,$rating)";
    if(mysql_query($db, $sql)) {

        echo "Film added.";

    } else {

        echo "Error adding film: " .mysql_error($db);

    }

} elseif($_REQUEST["oper"]=='edit') {

    $sql = "UPDATE film SET title='$title', description='$description', length='$length', rating='$rating' WHERE film_id=$filmid";
    if(mysql_query($db, $sql)) {

        echo "Film edited.";

    } else {

        echo "Error editing film: " .mysql_error($db);

    }

} elseif($_POST["oper"]=='del') {

    $sql = "DELETE FROM film WHERE film_id=$filmid";
    if(mysql_query($db, $sql)) {

        echo "Film deleted.";

    } else {

        echo "Error deleting film: " .mysql_error($db);

    }

}

mysql_close($db);

?>