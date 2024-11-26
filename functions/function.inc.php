<?php

// ---------------------------------------
//				FONCTIONS BD
// ---------------------------------------

// Fonction de connexion à la bd
function BDconnect(){
	try{
		$bdd=new PDO('mysql:host=localhost;dbname=dwaprojet;charset=utf8','dwauser','A123456*', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
		
	}
	catch (Exception $e){
		die('Erreur : ' . $e->getMessage());
	}

	return $bdd;
}

// Fonction de fermeture de la Requete

function RequestClose($req){
	$req->closeCursor();
}


// ---------------------------------------
//			FONCTIONS AFFICHAGE
// ---------------------------------------

// affichage post

function displayPost(Post $post) {

	$user_id=$post->getUser();
	$likeid=$post->getPostId()."like";
	$user = getUserFromPost($user_id);
	echo "<div id=\"".$post->getPostId()."\" class=\"container postelement\">\n";
	echo "<div class=\"container\">\n";
	echo "<div class=\"row\">\n";
	echo "<img src=";displayProfilePicture($user);echo " alt=\"Profil utilisateur\" class=\"rounded-circle p-2 bd-highlight\" width=\"80px\" height=\"80px\">";
	echo "<p class=\"pseudopostelement\">".$user->getUsername()." -</p>\n";
	echo "<p class=\"idpostelement\"> @".$user->getIdUser()."</p>\n";
	echo "</div>\n";

	echo "<div class=\"row textpostelement\">\n";
	echo "<p>".$post->getTextPost()."</p>\n";
	echo "</div>\n";

	$imgpost = $post->getImagePost();
	if($imgpost != "") {
		echo "<img class=\"rounded mx-auto d-block\"src=\"".$imgpost."\" width=\"30%\" alt=\"post image\">";
	}

	echo "<div class=\"row\">\n";
	echo "<p>Le ".date_format($post->getDatePost(), 'd/m/Y \à H:i')."</p>\n";
	echo "</div>\n";

	echo "<div class=\"row justify-content-center commentlike\">\n";
		echo "<div class=\"btn btn-lg likebutton orangecolor\" data-islike=\"".userlike($post->getLike(),$_SESSION['User'])."\">\n";
			echo "<svg id=\"$likeid\" width=\"1em\" height=\"1em\" viewBox=\"-0.5 -1 17 17\" class=\"bi bi-heart-fill\" fill=\"".userlike($post->getLike(),$_SESSION['User'])."\" stroke=\"orange\" xmlns=\"http://www.w3.org/2000/svg\">\n";
			echo "<path fill-rule=\"evenodd\" d=\"M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z\"/>\n";
			echo "</svg>\n";
			echo "<span class=\"nblike\"> ".$post->getLike()->getNumberLikes()."</span>\n";
		echo "</div>\n";

	echo "<div class=\"btn btn-lg \">\n";
		echo "<a href=\"comments.php?idpost=".$post->getPostId()."\">\n";
			echo "<svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-chat-dots\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">\n";
  				echo "<path fill-rule=\"evenodd\" d=\"M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z\"/>\n";
				echo "<path d=\"M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z\"/>\n";
			echo "</svg>\n";
			echo "Commentaires\n";
		echo "</a>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
	echo "</div>\n";
}

/*function displayLikeNdComment(Post $post) {

	$likeid=$post->getPostId()."like";
	echo "<div class=\"row justify-content-center commentlike\">\n";
		echo "<div class=\"btn btn-lg likebutton orangecolor\" data-islike=\"".userlike($post->getLike(),$_SESSION['User'])."\">\n";
			echo "<svg id=\"$likeid\" width=\"1em\" height=\"1em\" viewBox=\"-0.5 -1 17 17\" class=\"bi bi-heart-fill\" fill=\"".userlike($post->getLike(),$_SESSION['User'])."\" stroke=\"orange\" xmlns=\"http://www.w3.org/2000/svg\">\n";
				echo "<path fill-rule=\"evenodd\" d=\"M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z\"/>\n";
			echo "</svg>\n";
			echo "<span class=\"nblike\"> ".$post->getLike()->getNumberLikes()."</span>\n";
		echo "</div>\n";

		echo "<div class=\"btn btn-lg \">\n";
			echo "<a href=\"comments.php?idpost=".$post->getPostId()."\">\n";
			echo "<svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-chat-dots\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">\n";
  				echo "<path fill-rule=\"evenodd\" d=\"M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z\"/>\n";
				echo "<path d=\"M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z\"/>\n";
			echo "</svg>\n";
			echo "Commentaires\n";
			echo "</a>\n";
		echo "</div>\n";
	echo "</div>\n";
}*/

/*function displayComment(Comment $comment, User $user) {
	
//	$user = $post->getUser();
	$urlprofilpicture = displayProfilePicture($user);
	echo "<div id=\"postelement\" class=\"container\">";
	echo "<div class=\"container\">";
	echo "<div class=\"row\">";
	echo "<img src=\"";displayProfilePicture($user);
	echo "\" alt=\"Profil utilisateur\" class=\"rounded-circle p-2 bd-highlight\" width=\"80px\" height=\"80px\">";
	echo "<p id=\"pseudopostelement\">".$user->getUsername()."</p>";
	echo "<p id=\"idpostelement\"> @".$user->getIdUser()."</p>";
	echo "</div>";

	echo "<div id=\"textpostelement\" class=\"row\">";
	echo "<p>".$comment->getTextComment()."</p>";

	echo "</div>";
	echo "<div class=\"row\">";
	echo "<p>Le".date_format($user->getDateComment(), 'Y-m-d à H:i:s')."</p>";
	echo "</div>";
	echo "<div class=\"row justify-content-center\" id=\"commentlike\">";
	echo "<div class=\"btn btn-lg \">";

	echo "<a href=\"\">";

	echo "<svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-heart\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">";
	echo "<path fill-rule=\"evenodd\" d=\"M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z\"/>";
	echo "</svg>";
	echo "Like";
	echo "</a>";
	echo "</div>";

	echo "<div class=\"btn btn-lg \">";
	echo "<a href=\"comments.php\">";
	echo "<svg width=\"1em\" height=\"1em\" viewBox=\"0 0 16 16\" class=\"bi bi-chat-dots\" fill=\"currentColor\" xmlns=\"http://www.w3.org/2000/svg\">";
  	echo "<path fill-rule=\"evenodd\" d=\"M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z\"/>";
	echo "<path d=\"M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z\"/>";
	echo "</svg>";
	echo "Commentaires";
	echo "</a>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
	echo "</div>";
}*/


function displayProfilePicture(User $user){

    $filename = "./icons/".$user->getIcon();
    if ($user->getIcon()) {
        echo $filename;
    }
    else{
        echo "./icons/avatar-2.png";
    }
}

function returnpp(User $user){

    $filename = "./icons/".$user->getIcon();
    if ($user->getIcon()) {
        return $filename;
    }
    else{
        return "./icons/avatar-2.png";
    }
}


function deleteImage(User $user){

	$files=glob("../icons/".$user->getIdUser().".*");
    foreach ($files as $filename) {
        unlink($filename);
    }
}

function islike(Like $like, User $user){

	$id_user=$user->getIdUser();
	if (in_array($id_user, $like->getLiked() ) ) {
    	return "false";
	}
	else {
		return "true";
	}

}

function userlike(Like $like, User $user){
	$id_user=$user->getIdUser();
	if (in_array($id_user, $like->getLiked() ) ) {
		return "orange";
	}
	else {
		return "white";
	}

}


function getUserFromPost($user_id){
	//$_SESSION['User']->getIdUser();
	$bdd = BDConnect();
	$requete = 'SELECT * FROM Users WHERE id_user= ?';
		$req = $bdd->prepare($requete);
		$req->execute(array($user_id));
		$row = $req->fetch();
		$user = new User($row[0], $row[1], $row[5] , $row[2] , $row[3] , $row[4] , $row[7], $row[6]);
		return $user;
}

/*
function displayAllPost(){
	//$_SESSION['User']->getIdUser();
	$bdd = BDConnect();
	$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$requete = 'SELECT * FROM post;';
	foreach  ($bdd->query($requete) as $row) {
//	foreach ($row as $key => $value) {
		$like = createPostLike($row['id_post']);
		if (empty($row['url_image'])){$row['url_image']='NULL';}
		$date = date_create($row['datePost']);
		$post = new Post($row['id_post'],$row['text'],$row['url_image'],$like,$row['id_writer'],$date);
		displayPost($post);		
}

}
*/

function createPostLike($id_post){
	$liked;
	$i=0;
	$bdd = BDConnect();
	$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	$requete1 = 'SELECT COUNT(*) FROM LikePost WHERE id_post= ?';
	$requete2 = 'SELECT id_user FROM LikePost WHERE id_post= ?';
		
	$req = $bdd->prepare($requete1);
	$req2 = $bdd->prepare($requete2);

	$req->execute(array($id_post));
	$req2->execute(array($id_post));

	$row = $req->fetch();
	$row2 = $req2->fetchAll();
	$like = new Like(intval($row['COUNT(*)']));
	if(!empty($row2)){
		foreach ($row2 as $key => $value) {
			$liked[$i]=$value['id_user'];
			$i++;
		}
		$like->setLiked($liked);
	}
	return $like;
}

function createCommentLike($id_comment){
	$liked;
	$date;
	$i=0;
	$bdd = BDConnect();
	$bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		$requete1 = 'SELECT COUNT(*) FROM LikeComment WHERE id_comment= ?';
		$requete2 = 'SELECT id_user FROM LikeComment WHERE id_comment= ?';
		
		$req = $bdd->prepare($requete1);
		$req2 = $bdd->prepare($requete2);

		$req->execute(array($id_comment));
		$req2->execute(array($id_comment));

		$row = $req->fetch();
		$row2 = $req2->fetchAll();
	$like = new Like(intval($row['COUNT(*)']));
	if(!empty($row2)){
		foreach ($row2 as $key => $value) {
			$liked[$i]=$value['id_user'];
			$date[$i]=$value['dateLike'];
			$i++;
		}
		$like->setLiked($liked);
		$like->setDateLike($date);
	}

	return $like;
}


function deleteBanner(User $user){
    $files=glob("../banners/".$user->getIdUser().".*");
    foreach ($files as $filename) {
    	unlink($filename);
    }
}

function displayBanner(User $user){
	$extention=array("png","jpg","jpeg");
	$banner;
	foreach ($extention as $ext){
		$chemin="./banners/".$user->getIdUser().".".$ext;
		if (file_exists($chemin)){
			$banner=$chemin;
		}
	}

	if (!empty($banner)){
		echo $banner;
	} else{
		echo "./images/banner-orange.png";
	}
}

?>
