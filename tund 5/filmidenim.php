<?php
require("../../../config.php");
$username = "karlreimond";

require("fnc_film.php");

//loen andmebaasist filmide info
$filmhtml = readfilms();
?>
  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?></h1>
<a href="home.php">Tagasi kodulehele</a>
<hr>
</ul>
<?php echo $filmhtml; ?>
</body>
</html>
