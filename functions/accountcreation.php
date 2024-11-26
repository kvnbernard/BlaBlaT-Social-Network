<!--
	Le formulaire de creation de compte redirigera ici
 	On realisera alors l'ensemble des tests pour verifier la non existence du mail et de l'identifiant d'utilisateur

 	On creera alors le compte et on redirigera vers la page index.php
 -->
<?php 
	// on inclut les fonctions que nous avons crée
	include("function.inc.php");
	// Connexion à la BD
	$bdd = BDConnect();

	// On effectue une requete pour verifier la non existence de compte avec cet identifiant ou ce mail
	$requete = 'SELECT id_user, mail FROM Users WHERE id_user= ? OR mail=? ';
	$req = $bdd->prepare($requete);
	$req->execute(array($_POST["idcreation"], $_POST["mailcreation"]));

	if($req->rowCount() == 0){
		// Non existence de compte avec ce mail ou cet identifiant
		// On creatione le compte
		$requete = 'INSERT INTO Users (id_user, username, firstname, lastname, birthdate, passwords, url_icon, mail) VALUES (?,?,?,?,?,?,?,?)';
		$req = $bdd->prepare($requete);
		$req->execute(array($_POST["idcreation"], $_POST["pseudocreation"], $_POST["prenomcreation"], $_POST["nomcreation"], $_POST["birthdatecreation"], password_hash($_POST["mdpcreation"],PASSWORD_DEFAULT), NULL, $_POST["mailcreation"]));
		RequestClose($req);
		header('Location:../index.php');
		//echo "ui";
	}
	else{
		// Id ou mail deja existant
		// Pas de creation de compte
		header('Location:../index.php');
		//echo "non";
	}














 ?>