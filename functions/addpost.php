<?php 
/*
	Script permettant l'eenregistrement des posts dans la base de donnée

*/	
	require_once("function.inc.php");
	require_once("../class/User.class.php"); 
	require_once("../class/Post.class.php");
	session_start();
	if(empty($_SESSION["User"])){
		header("Location:index.php");
	}
	echo $_FILES["image"]["name"];
	
	// connexion à la BD
	
	$bdd = BDConnect();
	
	// Verification si le post est vide ou pas

	if(empty($_POST["message"])){
		header('Location:feed.php');
	}

	// Verification si un fichier est ajouté au post
	$file = NULL;
	if(isset($_FILES['image']) && (!empty($_FILES['image']))){
		// verification MIME fichier
		$mime = mime_content_type($_FILES['image']["tmp_name"]);
		if($mime == "image/png" || $mime == "image/jpeg"|| $mime == "image/gif"){
			// enregistrement de l'image dans les dossiers
			$info = new SplFileInfo($_FILES['image']['name']);
			$file_type = $info->getExtension();
			$folder ="postimages/";
			$filesize = $_FILES["image"]["size"];
			$filename = time().'_'.$filesize.'_'.rand(1000, 9999).'.'.$file_type;
			$file = $folder.$filename ;
			if(!move_uploaded_file($_FILES['image']['tmp_name'], "../".$file)) {
				// ERREUR dans l'envoi du fichier au serveur
				header('Location:../feed.php');
			}
		}
	}
	if(strlen($_POST["message"]) <= 300){
		$tmpuser = $_SESSION['User'];
		$req = $bdd->prepare("INSERT INTO Post ( id_writer, text, url_image, datePost) VALUES ( ?, ?, ?, ?)");
		$req->execute(array( $tmpuser->getIdUser(), $_POST["message"] , $file, date("Y-m-d H:i:s")));
		RequestClose($req);
		echo $_FILES["image"]["name"];
		header('Location:../feed.php');
		
	}
	else{
		header('Location:../feed.php');
	}



?>