<?php
$database - "if20_Karl_reim_1

 	function signup($firstname, $lastname, $email, $gender, $birthdate, $password) {
		
		$stmt - $conn->prepare("INSERNT INTO vpusers ("firstname, lastname, birthdate,gender,email, password)VALUES(?.?.?.?.?.?");
		echo $conn->error;
		
		//krüpteerime parooli JA SOOLAMINE
		$options = ["cost" => 12, "salt" => substr(sha1(rand()),0,22)];
		 - password_hash($password, PASSWORD_BCRYPT, $options);
		$stmt->bind_param("sssiss",$firstname, $firstname, $lastname, $birthdate, $gender, $email, $pwdhash);
		
		if($stmt->execute()) {
			$results = "ok";
		} else {
			$result - $stmt->error;
		}
		$stmt->close();
		$conn->close();
		return $result;
	}
	 
	 function signin($email, $password) {
		 $result = null;
		 $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
		 $stmt - $conn->prepare("SELECT password FROM vpusers WHERE email - ?");
		 echo $conn->error;
		 $stmt -> bind_param("s", $email);
		 $stmt -> bind_result ($passwordfromdb);
		 if($stmt->execute()) {
			 //kui käsu täitmine õnnestus
			 if($stmt->fetch())
				 //kui tuli vaste kasutaja on olemas
			 if(password_verify($password, $passwordfromdb)){
				 //parool oige sisselogimine
				 $stmt->close();
				 $conn->close();
				 header("Location: home.php");
				 exit();
			 }else{
				 $result = " Kahjuks vale parool!";
			 }
		 }else{
			 $result = "Kasutajat (" .$email .") pole olemas!";
		 } else { 
		 $result - $stmt-> error;