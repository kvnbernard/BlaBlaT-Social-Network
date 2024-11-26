<?php

include("function.inc.php");
include("../class/User.class.php");
include("../class/Post.class.php");
include("../class/Like.class.php");

session_start(); 
    if(empty($_SESSION["User"])){
        header("Location:index.php");
    }

if(isset($_GET["iduser"])) {
	$userIndex = 0;
	$comIndex = 0;

	$bdd = BDConnect();

	$req = $bdd->prepare("(SELECT * FROM Post WHERE id_writer = ?) UNION (SELECT id_post, id_writer, text, url_image, dateLike AS datePost FROM Post NATURAL JOIN LikePost WHERE id_user = ?) UNION (SELECT * FROM Post WHERE id_writer IN (SELECT id_followed FROM Follow WHERE id_follower = ?)) UNION (SELECT id_post, id_writer, text, url_image, dateLike AS datePost FROM Post NATURAL JOIN LikePost WHERE id_user IN (SELECT id_followed FROM Follow WHERE id_follower = ?)) ORDER BY datePost DESC");
	$req->execute(array($_GET["iduser"],$_GET["iduser"], $_SESSION["User"]->getIdUser(),$_SESSION["User"]->getIdUser()));
	if($req->rowCount() == 0) {
		echo "<p class=\"text-center\">Vous n'avez rédigé aucun post</p>";
	}
	else {
		while(($row = $req->fetch()) /*&& ($userIndex < 5)*/) {

			/*$req2 = $bdd->prepare("SELECT * FROM Users WHERE id_user = ?");
			$req2->execute(array($row[1]));
			$rowuser = $req2->fetch();
			echo "<div class=\"container postelement\">";
			echo "<div class=\"row\">";
			echo "<div class=\"col\">";
			if($row[1] != $_GET["iduser"]) {
				echo "<p class=\"font-italic\"> Vous avez aimé ce post </p>";
			}
			$user = new User($rowuser[0], $rowuser[1], $rowuser[5] , $rowuser[2] , $rowuser[3] , $rowuser[4] , $rowuser[7], $rowuser[6]);
			$icon = returnpp($user);
			echo "<div>";
			echo "<a class=\"nameidpost\" href=\"profil.php?iduser=".$row[1]."\"><img class=\"rounded-circle p-2 bd-highlight\" width=\"80px\" height=\"80px\" src=\"".$icon."\" alt=\"Profil Picture\">".$rowuser[1]." - @".$row[1]."</a>";*/
			$userPostLike = createPostLike($row[0]);
			$userPostDate = date_create($row[4]);
			$userPost = new Post($row[0],$row[2],$row[3],$userPostLike,$row[1],$userPostDate);
			//echo $row[1];
			$reqlike = $bdd->prepare("SELECT * FROM LikePost WHERE id_post = ? AND id_user = ?");
			$reqlike->execute(array($row[0], $_SESSION["User"]->getIdUser(),));
			if(/*$row[1] != $_SESSION["User"]->getIdUser()*/$reqlike->rowCount() == 1) {
				echo "<p class=\"font-italic\" style=\"margin-left:15%; padding-top:1em;\"> Vous avez aimé ce post </p>";
			}
			/*echo "<p>".$row[2]."</p>";
			if(!is_null($row[3])) {
				echo "<img class=\"rounded mx-auto d-block\"src=\"".$row[3]."\" width=\"30%\" alt=\"post image\">";
			}
			echo "<p> Le ".date_format($userPostDate, 'Y-m-d \à H:i')."</p>";*/

			//displayLikeNdComment($userPost);

			displayPost($userPost);

			echo "</div>";
			echo "</div>";
			echo "</div>";
			echo "</div>";
			$userIndex++;
		}
	}
/*
	$followedReq = $bdd->prepare("SELECT id_followed FROM Follow WHERE id_follower = ?");
	$followedReq->execute(array($_GET["iduser"]));
	if($followedReq->rowCount() == 0) {
			$allPostReq = $bdd->prepare("SELECT * FROM Post WHERE id_writer != ? ORDER BY datePost DESC");
			$allPostReq->execute(array($_GET["iduser"]));
			if($allPostReq->rowCount() == 0) {
				echo "<p class=\"text-center\">Il n'y a aucun post sur le réseau social Blabla't</p>";
			}
			else {
				while($allPostRow = $allPostReq->fetch()) {
					$allPostLike = createPostLike($allPostRow[0]);
					$allPostDate = date_create($allPostRow[4]);
					$allPost = new Post($allPostRow[0],$allPostRow[2],$allPostRow[3],$allPostLike,$allPostRow[1],$allPostDate);
					displayPost($allPost);
				}
			}

		}
	else {
		while($followedRow = $followedReq->fetch()) {
			$postReq = $bdd->prepare("(SELECT * FROM Post WHERE id_writer = ?) UNION (SELECT id_post, id_writer, text, url_image, dateLike AS datePost FROM Post NATURAL JOIN LikePost WHERE id_user = ?) ORDER BY datePost DESC");
			$postReq->execute(array($followedRow[0],$followedRow[0]));
			while($postRow = $postReq->fetch()) {
				$postLike = createPostLike($postRow[0]);
				$date = date_create($postRow[4]);
				$post = new Post($postRow[0],$postRow[2],$postRow[3],$postLike,$postRow[1],$date);
				if($postRow[1] != $followedRow[0]) {
					echo "<p class=\"font-italic\">".$followedRow[0]." à aimé le post suivant</p>";
				}
				displayPost($post);
			}
		}
	}
	*/
}
else {
	echo "<p class=\"text-center\">Erreur lors de l'affichage des posts ...</p>";
}


?>