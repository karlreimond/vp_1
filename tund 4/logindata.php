<?php
//require("../../../config.php");
//$database = "if20_Karl_reim_1";
$firstname="";
$lastname="";
$gender="";
$email="";
require("header.php");

  //$passwordinput === $passwordsecondaryinput
  //$passwordinput !=== $passwordsecondaryinput
$firstnameerror="";
$lastnameerror="";
$gendererror="";
$emailerror="";
$passworderror="";
$passwordsecondaryerror="";
if(isset($_POST["accountdatasubmit"])) {
    if(strlen($_POST["passwordinput"]) < 8) {
    $passworderror=" Salasõna ei tohi olla väiksem kui 8 tähte!";
    }
    if(empty($_POST["firstnameinput"])) {
        $firstnameerror = "Palun sisestage oma eesnimi!";
    } else {
        $firstname = ($_POST["firstnameinput"]);
    }
    if(empty($_POST["lastnameinput"])) {
        $lastnameerror = "Palun sisestage oma perekonnanimi!";
    }else {
        $lastname = ($_POST["lastnameinput"]);
    }
    if(($_POST["passwordinput"]) != ($_POST["passwordsecondaryinput"])) {
        $passwordsecondaryerror = "Sisestatud paroolid ei ühti!";
    }
    if(empty($_POST["emailinput"])) {
        $emailerror = "Palun sisestage oma email!";
    } else {
        $email = ($_POST["emailinput"]);
	}
	if(empty($_POST["genderinput"])) {
        $gendererror = "Palun sisestage oma sugu!";
    } else {
        $gender = ($_POST["genderinput"]);
    }
}
?>
<a href="home.php">Tagasi avalehele</a>
<hr>
<p>Loo uus kasutaja</p>
<br>
<form method="POST">
 <label for="firstnameinput">Eesnimi</label>
 <input type="text" name="firstnameinput" id="firstnameinput" value="<?php echo $firstname; ?>"><span><?php echo $firstnameerror; ?></span>
 <br>
  <label for="lastnameinput">Perekonnanimi</label>
 <input type="text" name="lastnameinput" id="lastnameinput" value="<?php echo $lastname; ?>"><span><?php echo $lastnameerror; ?></span>
 <br>
 <label for="genderinput">Sugu</label>
 <input type="radio" name="genderinput" id="gendermale" value="1" <?php if($gender == "1"){echo " checked";}?>><label for="gendermale">Mees</label><span><?php echo $gendererror; ?></span>
 <br>
 <label for="genderinput">Sugu</label>
 <input type="radio" name="genderinput" id="genderfemale" value="2" <?php if($gender == "2"){echo " checked";}?>><label for="genderfemale">Naine</label><span><?php echo $gendererror; ?></span>
 <br>
 <label for="emailinput">E-posti aadress</label>
 <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
 <br>
 <label for="passwordinput">Salasõna</label>
 <input type="password" name="passwordinput" id="passwordinput" ><span><?php echo $passworderror; ?></span>
 <br>
 <label for="passwordsecondaryinput">korda Salasõna</label>
 <input type="password" name="passwordsecondaryinput" id="passwordsecondaryinput" ><span><?php echo $passwordsecondaryerror; ?></span>
 <br>
 <input type="submit" name="accountdatasubmit" value="Loo konto!">	
 </form>

 