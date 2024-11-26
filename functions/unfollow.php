<?php 

include("function.inc.php");
include("../class/User.class.php");
if(isset($_POST["follower"]) && isset($_POST["followed"])){
	$bdd = BDConnect();
	$req = $bdd->prepare("DELETE FROM  Follow WHERE id_follower = ? AND id_followed = ?");
	$req->execute(array($_POST["follower"], $_POST["followed"]));
}
 ?>