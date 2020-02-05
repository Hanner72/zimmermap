<html>
 <head>
  <title>Update Formular</title>
 </head>
<body>


<form action="<?php echo $PHP_SELF; ?>" method="post">
<?php

require_once('inc/config.inc.php');

$link2 =  mysql_connect( $dbserver, $dbuser, $dbpass  ) or die( "Momentan leider keine Verbindung zum Server. Wir bitten um Ihr Verstaendnis!" );
mysql_select_db( $dbname, $link2 ) or die ( "Server Error. Wir bitten um Ihr Verstaendnis" );

if(isset($_POST["submitted"])) {
    $_sql = "UPDATE markers";
    $_sql .= " SET name='".$_POST["name"]."'";
    $_sql .= " SET address='".$_POST["address"]."'";
    $_sql .= " SET mobil='".$_POST["mobil"]."'";
    $_sql .= " SET tel='".$_POST["tel"]."'";
    $_sql .= " SET mail='".$_POST["mail"]."'";
    $_sql .= " SET www='".$_POST["www"]."'";
    $_sql .= " SET lat='".$_POST["lat"]."'";
    $_sql .= " SET lng='".$_POST["lng"]."'";
    $_sql .= " SET type='".$_POST["type"]."'";
    $_sql .= " WHERE id='".$_POST["id"]."'";
    
    mysql_query($_sql,$link2);
} else {
    $ergebnis = mysql_query( "SELECT * FROM markers ORDER BY name" );

    while ( $datensatz = mysql_fetch_array( $ergebnis ) ) {
        $id = $datensatz["id"];
        $name = $datensatz["name"];
        $address = $datensatz["address"];
        $mobil = $datensatz["mobil"];
        $tel = $datensatz["tel"];
        $mail = $datensatz["mail"];
        $www = $datensatz["www"];
        $lat = $datensatz["lat"];
        $lng = $datensatz["lng"];
        $type = $datensatz["type"];

?>
<table>
 <tr>
  <td valign="top"><input type="text" name="id" size="3" value="<?php echo $id; ?>"></td>
  <td valign="top"><input type="text" name="name" size="25" value="<?php echo $name; ?>"></td>
  <td valign="top"><input type="text" name="address" size="35" value="<?php echo $address; ?>"></td>
  <td valign="top"><input type="text" name="mobil" size="10" value="<?php echo $mobil; ?>"></td>
  <td valign="top"><input type="text" name="tel" size="10" value="<?php echo $tel; ?>"></td>
  <td valign="top"><input type="email" name="mail" size="20" value="<?php echo $mail; ?>"></td>
  <td valign="top"><input type="www" name="www" size="25" value="<?php echo $www; ?>"></td>
  <td valign="top"><input type="text" name="lat" size="10" value="<?php echo $lat; ?>"></td>
  <td valign="top"><input type="text" name="lng" size="10" value="<?php echo $lng; ?>"></td>
  <td valign="top"><label>Typ:
    <select name="type" size="1" value="<?php echo $type; ?>">
      <option>Hotel</option>
      <option>Gasthaus</option>
      <option>Privat</option>
    </select>
  </label></td>
  <td><p></td>
 </tr>                   
</table>

<?php
    }

mysql_close($link2);
     
?>
<input type="submit" name="submitted" value="&Uuml;bernehmen">
</form>
<?php

}

?>
</html>