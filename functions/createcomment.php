<?php 

require_once("function.inc.php");
require_once("../class/User.class.php"); 
require_once("../class/Post.class.php");
session_start();
if(empty($_SESSION["User"])){
	header("Location:index.php");
}


if(isset($_POST["message"]) && isset($_POST["idpost"])){
	// connexion à la BD
	$bdd = BDConnect();
	$tmpuser = $_SESSION['User'];
	$req = $bdd->prepare("INSERT INTO Comments (id_writer, id_post_commented, text, dateComment) VALUES (?,?,?,NOW())");
	$req->execute(array($tmpuser->getIdUser(),intval($_POST["idpost"]),$_POST["message"]));
	// redirection
	header('Location:../comments.php?idpost='.$_POST["idpost"]);
}
else{
	header('Location:../feed.php');
}




?>