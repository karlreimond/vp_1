<?php 
 require("../../../config.php");
 $database = "if20_karl_reim_1";
 if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])) {
	 //loome andmebaasiga ühenduse
	 $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
	 //valmistan ette sql käsu andmete kirjutamiseks
	 $stmt = $conn->prepare("INSERT INTO myideas (idea) VALUES (?)");
	 echo $conn->error;
	 //i -ineger; d - decimal, s - string
	 $stmt->bind_param("s", $_POST["ideainput"]);
	 $stmt->execute();
	 $stmt->close();
	 $conn->close();
 }
 
 //loen andmebaasist senised mõtted
 $ideahtml = "";
 $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
 $stmt = $conn->prepare("SELECT idea FROM myideas");
?>
<a href="home.php">Tagasi kodulehele</a>
<hr>
<form method="POST">
  <label>Kirjutage oma esimene pähe tulev mõte!</label>
  <input type="text" name="ideainput" placeholder="mõttekoht">
  <input type="submit" name="ideasubmit" value="Saada mõte teele!">
</form>