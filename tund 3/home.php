<?php
  //var_dump($_POST);
  require("../../../config.php");
  $database = "if20_karl_reim_1";
  if(isset($_POST["ideasubmit"]) and !empty($_POST["idealinput"])){
	  //loome andmebaasiga ühendse
	  $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database);
	  //valmistan ette  SQL käsu andmete kirjutamiseks
	  $stmt = $conn->prepare("INSERT INTO myideas (idea) VALUES(?)");
	  echo $conn->error;
	  //i- integer taisarv, d decimal murdarv, a string
	  $stmt->bind_param("s", $_POST["idealinput"]);
	  $stmt->execute();
	  $stmt->close();
	  $conn->close();
  }
  //loen andmebaasist senised mõtted
   $ideahtml = "";
   $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database);
   $stmt = $conn->prepare("SELECT idea FROM myideas");
  //seon tulemuse muutuja
   $stmt->bind_result($ideafromdb);
   $stmt->execute();
   while($stmt->fetch()){
	   $ideahtml .= "<p>" .$ideafromdb ."</p>";
  }
  $stmt->close();
  $conn->close();
  $username = "Karl-Reimond Kõrs";
  $fulltimenow = date ("d.m.Y H:i:s");
  $hournow = date ("H");
  $partofday = "lihtsalt aeg";
  $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  //echo $weekdaynameset [1]; ei tee
  $weekdaynow = date("N");
  if($hournow < 7){
	 $partofday = "uneaeg";
  }
  if($hournow >= 8 and $hournow < 18){
	  $partofday = "akadeemilise aktiivsuse aeg";
  }
  if($hournow >= 13 and $hournow < 18){
	  $partofday = "Lõuna aeg";
  }  
  if($hournow >= 15 and $hournow < 18){
	  $partofday = "füüsilise aktiivsuse aeg";
  }
  if($hournow >= 18 and $hournow < 18){
	  $partofday = "akadeemilise aktiivsuse aeg";
  }
  //vaatame semestri kulgemist
  $semesterstart = new DateTime("2020-8-31");
  $semesterend = new DateTime("2020-12-13");
  //selgitame välja nende vahe ehk erinevus
  $semesterduration = $semesterstart->diff($semesterend);
  //leiame selle päevade arvuna
  $semesterdurationdays = $semesterduration->format("%r%a");
  //tänane päeva
  $today = new DateTime("now");
  //if($fromsemesterstartdays < 0) {semester pole peale hakanud}
  //mitu päeva on möödunud semestri algusest
  //palju on jäänud semestri lõpuni
  
  $semestrilõpuni = $semesterstart->diff($semesterend);
  if($semestrilõpuni < 0){
     $semestrilõpuni = "Semester on lõppenud";
  }
  if($möödunudsemalg < 0){
	 $semesterstart = "Semester pole veel alanud";
  }	  
  // vaatame mitu protsenti õppetööst on tehtud
  $semesterprecentage = round($möödunudsemalg / $semesterdurationdays * 100,1);
  $allfiles = scandir("../vp/vp_pics/");
  //echo allfiles
  //var dump($allfiles);
  $picfiles - array_slice($allfiles, 2);
  //array slice votab 2 esimest elementi ara
  $imghtml = "";
  $piccount = count($picfiles);
  //$i = $i + 1;
  //$i ++;
  //$1 +- 3
  for($i = 0;$i < $piccount; $i ++){
	  //<img src="../img/pildifail" alot-"tekst,">
	  $imghtml .- '<img src="../vp_pics/' .$picfiles[$i] .'" alt-"Tallinna Ülikool">';
  }  
  require("header.php");
?>

  <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $username; ?></h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
  <p>Leht on loodud veebiprogrammeerimise kursuse raames Tallina ÜLikooli Digitehnoloogiate instituudis. <a href="http://www.tlu.ee"> Tallinna Ülikooli</a> Digitehnoloogiate instituudis. </p>
  <p> Lehe avamise hetkel oli: <?php echo $weekdaynameset[$weekdaynow-1].",".$fulltimenow; ?><p>
  <p><?php echo "Parajasti on " .$partofday ."."; ?></p>
<p> Mul pole endiselt orna aimu mida ma teen aga ma loodan, et varsti saan aru
  <hr>
  <?php echo $imghtml; ?>
   <hr>
   <form method="POST">11
     <label>Kirjutage oma esimene pähe tulev mõte!</label>
     <input type="text" name="ideainput" placeholder="mõttekoht">
     <input type="sumbit" name="ideasumbit" value="saada mõte teele!">
   </form>
   </hr>
</body>
</html>