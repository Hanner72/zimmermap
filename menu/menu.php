<!-- Load an icon library to show a hamburger menu (bars) on small screens -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link type="text/css" href="http://strabag-sport.at/strabag-apps/menu/menu.css" rel="stylesheet">

<div class="topnav" id="myTopnav">
  <a href="http://strabag-sport.at/strabag-apps/" class="active">Home</a>
  <a href="http://fotos.strabag-sport.at/akqui.php"><i class="fa fa-picture-o"></i> Akqui</a>
  <a href="http://fotos.strabag-sport.at/baustellen.php"><i class="fa fa-picture-o"></i> BVH</a>
  <a href="http://fotos.strabag-sport.at/referenzen.php"><i class="fa fa-picture-o"></i> Referenzbilder</a>
  <a href="http://fotos.strabag-sport.at/lieferscheine.php"><i class="fa fa-file-text"></i> Lieferscheine</a>
  <a href="http://zimmer.strabag-sport.at/"><i class="fa fa-home icon-circle"></i> Zimmer</a>
  <a href="http://bewe.strabag-sport.at/"><i class="fa fa-cart-arrow-down"></i> Bestellwesen</a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<script>
function myFunction() {
  var x = document.getElementById("myTopnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>