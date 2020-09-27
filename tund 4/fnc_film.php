<?php
$database = "if20_Karl_reim_1";

//andmebaasist filmide lugemise funktsioon
function readfilms() {  
	//var_dump($GLOBALS);
	$conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	//$stmt = $conn->prepare("SELECT pealkiri, aasta, kestus, zanr, tootja, lavastaja FROM film");
	$stmt = $conn->prepare("SELECT * FROM film");
	//seon tulemuse muutujaga
	$stmt->bind_result($titlefromdb, $yearfromdb, $durationformdb, $genrefromdb, $studiofromdb, $directorfromdb);
	$stmt->execute();
	$filmhtml = "\t <ol> \n>";
	while($stmt->fetch()) {
		$filmhtml .= "<li>" .$titlefromdb ."</li \n>";
		$filmhtml .= "\t \t \t <ul> \n";
		$filmhtml .= "\t \t \t \t <li>Aasta: " .$yearfromdb ."</li> \n";
		$filmhtml .= "\t \t \t \t <li>Kestus: " .$durationformdb ." minutit.</li> \n";
		$filmhtml .= "\t \t \t \t <li>Žanr: " .$genrefromdb ."</li> \n";
		$filmhtml .= "\t \t \t \t <li>Tootja: " .$studiofromdb ."</li> \n";
		$filmhtml .= "\t \t \t \t <li>Lavastaja: " .$directorfromdb ."</li> \n";
		$filmhtml .= "\t \t \t </ul> \n";
		$filmhtml .= "</li> \n";
 }
 $filmhtml .= "\t </ol \n>";
 
 return $filmhtml;
 }//readfilms lõppeb
 
 //Salvestan sisetatud filmideinfo andmebaasi
 function storefilminfo ($title, $year, $duration, $genre, $studio, $director){
	 $success = 0;
	 $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
	 $stmt = $conn->prepare("INSERT INTO film(pealkiri, aasta, kestus, zanr, tootja, lavastaja)VALUES(?,?,?,?,?,?)");
	 echo $conn->error;
	 $stmt->bind_param("siisss", $title, $year, $duration, $genre, $studio, $director);
	 if($stmt->ecevute()){
		 $success = 1;
	 }
	 $stmt->execute();
	 
	 $stmt->close();
     $conn->close();
  }