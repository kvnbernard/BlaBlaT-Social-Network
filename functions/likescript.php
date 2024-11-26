<?php
include("../class/User.class.php");
include("../class/Like.class.php");
include("function.inc.php");
session_start();


$lik=explode( 'like',$_GET['postliked'] );
$typeElment=explode( 'container ',$_GET['typelement']);

if($typeElment[1]=="postelement"){

	$like = createPostLike($lik[0]);
	$islike=islike($like,$_SESSION['User']);
	$bdd = BDConnect();
	$tmpuser = $_SESSION['User'];
	if($islike=="true"){
		$req = $bdd->prepare("INSERT INTO LikePost (id_post, id_user, dateLike) VALUES (?,?,NOW())");
		$req->execute(array($lik[0],$tmpuser->getIdUser()));
	}
	else if ($islike=="false"){
		$req = $bdd->prepare("DELETE FROM LikePost wHERE id_post=? AND id_user=? ");
		$req->execute(array($lik[0],$tmpuser->getIdUser()));
	}
	
	$like2 = createPostLike($lik[0]);
	echo $like2->getNumberLikes();
}

else if ($typeElment[1]=="commentelement") {
	
	$like = createCommentLike($lik[0]);
	$islike=islike($like,$_SESSION['User']);
	$bdd = BDConnect();
	$tmpuser = $_SESSION['User'];
	if($islike=="true"){
		$req = $bdd->prepare("INSERT INTO LikeComment (id_comment, id_user) VALUES (?,?)");
		$req->execute(array($lik[0],$tmpuser->getIdUser()));
	}
	else if ($islike=="false"){
		$req = $bdd->prepare("DELETE FROM LikeComment wHERE id_comment=? AND id_user=? ");
		$req->execute(array($lik[0],$tmpuser->getIdUser()));
	}
	
	$like2 = createCommentLike($lik[0]);
	echo $like2->getNumberLikes();

}

?>