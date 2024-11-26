<?php 

include("function.inc.php");
include("../class/User.class.php");
if(isset($_POST["follower"]) && isset($_POST["followed"])){
	$bdd = BDConnect();
	$req = $bdd->prepare("INSERT INTO Follow (id_follower, id_followed) VALUES (?,?)");
	$req->execute(array($_POST["follower"], $_POST["followed"]));
}

 ?>