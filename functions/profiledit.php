<?php 
	require_once("function.inc.php");
	include("../class/User.class.php");
	session_start();

	$bdd = BDconnect();

	if(empty($_SESSION["User"])){
		header("Location:index.php");
	}
	else{

	if(!empty($_POST["pseudo"])){
		$_SESSION["User"]->setUserName($_POST["pseudo"]);
			$requete="UPDATE users SET username = :username WHERE id_user = :id_user;";
			$req = $bdd->prepare($requete);
		$req->execute(array(':username' => $_POST["pseudo"], ':id_user' => $_SESSION["User"]->getIdUser()));
	}

	if(!empty($_POST["prenom"])){
		$_SESSION["User"]->setFirstName($_POST["prenom"]);
			$requete="UPDATE users SET firstname = :firstname WHERE id_user = :id_user;";
			$req = $bdd->prepare($requete);
		$req->execute(array(':firstname' => $_POST["prenom"], ':id_user' => $_SESSION["User"]->getIdUser()));
	}

	if(!empty($_POST["nom"])){
		$_SESSION["User"]->setLastName($_POST["nom"]);
			$requete="UPDATE users SET lastname = :lastname WHERE id_user = :id_user;";
			$req = $bdd->prepare($requete);
		$req->execute(array(':lastname' => $_POST["nom"], ':id_user' => $_SESSION["User"]->getIdUser()));
		echo $_POST["nom"];
	}

	if(!empty($_FILES['image']['name'])) {
   		deleteImage($_SESSION["User"]);
   		$tailleMax = 1097152;
   		$extensionsValides = array('jpg', 'jpeg' , 'png');
   		if($_FILES['image']['size'] <= $tailleMax) {
   			$extension = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));
      			if(in_array($extension, $extensionsValides)) {
         				$chemin = "icons/".$_SESSION["User"]->getIdUser().".".$extension;
         				$image = move_uploaded_file($_FILES['image']['tmp_name'],"../".$chemin);
         				if($image) {
         					$requete="UPDATE Users SET url_icon = :icon WHERE id_user = :id_user;";
					$req = $bdd->prepare($requete);
					$req->execute(array(':icon' => $_SESSION["User"]->getIdUser().".".$extension, ':id_user' => $_SESSION["User"]->getIdUser()));
					$_SESSION["User"]->setIcon($_SESSION["User"]->getIdUser().".".$extension);

         				} 
      			}
  		 }
	}

	if (!empty($_FILES['banniere']['name'])){
		deleteBanner($_SESSION["User"]);
		$tailleMax=8000000000;
		$extensionsValides=array('jpg','jpeg','png');
		if($_FILES['banniere']['size']<=$tailleMax){
			$extension = strtolower(substr(strrchr($_FILES['banniere']['name'], '.'), 1));
			if(in_array($extension,$extensionsValides)){
				$chemin="banners/".$_SESSION["User"]->getIdUser().".".$extension;
				$banner=move_uploaded_file($_FILES['banniere']['tmp_name'],"../".$chemin);
			}
				
		}
	
	}	

	if(!empty($_POST["mdp"])){

		if(!empty($_POST["ancien-mdp"])){
			$hash=$_SESSION["User"]->getPassword();
			$valid = password_verify ( $_POST["mdp"], $hash );
			if ($valid){
				$msg="Ne gardez pas le même mot de passe";
			} else{
				$checked=password_verify($_POST["ancien-mdp"],$hash);
				if ($checked){
					echo $newhash=password_hash($_POST["mdp"],PASSWORD_DEFAULT);
					$_SESSION["User"]->setPassword($newhash);
					$requete="UPDATE users SET passwords = :passwords WHERE id_user = :id_user;";
					$req = $bdd->prepare($requete);
					$req->execute(array(':passwords' => $newhash, ':id_user' => $_SESSION["User"]->getIdUser()));
				}
			}
		}
	}

	header("Location:../options.php");


	}
 ?>