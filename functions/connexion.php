<!--
Le formulaire de connexion de index redirigera ici
On fera donc ici la connexion, et on créera une session

 -->
 <?php
session_start();
require("function.inc.php");
require_once("../class/User.class.php");
// On verifie que les elements sont pas vides
if(isset($_POST['identifiant']) && isset($_POST['mdp'])){
	// On se connecte à la BD
	$bdd = BDConnect();
	// On vérifie que les elements fournis correspondent à un compte

	$requete = 'SELECT id_user, passwords FROM Users WHERE id_user= ? ';
	$req = $bdd->prepare($requete);
	$req->execute(array($_POST["identifiant"]));
	// Verification qu'un compte existe
	$rowbd = $req->fetch();
	if(($req->rowCount() != 0) && (password_verify($_POST["mdp"], $rowbd[1]))){

		// On crée la variable de session de l'utilisateur, qui sera un objet utilisateur
		// On fait une requete des données de l'utilisateur
		$requete = 'SELECT * FROM Users WHERE id_user= ?';
		$req = $bdd->prepare($requete);
		$req->execute(array($_POST["identifiant"]));
		$row = $req->fetch();

		// On crée une variable de session pour l'utilisateur et on remplit les données
		$_SESSION["User"] = new User($row[0], $row[1], $row[5] , $row[2] , $row[3] , $row[4] , $row[7], $row[6]);
		
		// On redirige vers le feed.php
		header('Location: ../feed.php');

	}
	else{
		// On renvoie vers la page index
		session_destroy();
		header('Location: ../index.php');
	}
}
else{
	header('Location: ../index.php');
}












?>