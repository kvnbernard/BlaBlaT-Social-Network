<?php 
require_once("class/User.class.php");
include("functions/function.inc.php");
	session_start();
	if(empty($_SESSION["User"])){
		header("Location:index.php");
	}
 ?>
<?php include("templates/head.inc.php"); ?>
<body>
<?php include("templates/header.inc.php"); ?>
<?php include("templates/nav.inc.php"); ?>
<a class="btn rounded-circle researchbutton" href="research.php" title="Rechercher un utilisateur"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="white" xmlns="http://www.w3.org/2000/svg" > 
					  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
					  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/></svg>
</a>

<a class="btn rounded-circle messagebutton" href="createpost.php" title="Ecrire un message">
	<span class="fa fa-comment"></span>
</a>

<div class="container">

		<div class="row justify-content-center">

			

			<div class="container border-bottom">
			<!-- photo de profil generique à modifier -->
				<div class="row">
					<div class="col">
						<img  class="img-fluid" id="banner" style="width:100%;max-height:324px; object-fit:cover" src="<?php  displayBanner($_SESSION["User"]) ?>" alt="profile banner"/>
					</div>
				</div>
				<div class="row">
					<div class="col-3 , col-sm-2 , rounded mx-auto d-block">
						<img class="img-fluid  rounded-circle" id="profile_pic" src="<?php displayProfilePicture($_SESSION["User"]); ?>" alt="Profile Picture " />
					</div>
				</div>

				<div class="row">
					<div class="col">
						<h2><?php echo $_SESSION["User"]->getUserName() ?></h2>
						<p>@<?php echo $_SESSION["User"]->getIdUser() ?></p>
					</div>
				</div>

			</div>

			<div class="container">
				<?php 
					// affichage des posts et like de l'utilisateur courant 
					//echo $_SESSION["User"]->getIdUser();
					$bdd = BDconnect();
					$req = $bdd->prepare("(SELECT * FROM Post WHERE id_writer = ?) UNION (SELECT id_post, id_writer, text, url_image, dateLike AS datePost FROM Post NATURAL JOIN LikePost WHERE id_user = ?) ORDER BY datePost DESC");
					$req->execute(array($_SESSION["User"]->getIdUser(), $_SESSION["User"]->getIdUser()));
					//echo $req->rowCount();
					while($row = $req->fetch()){
						$req2 = $bdd->prepare("SELECT * FROM Users WHERE id_user = ?");
						$req2->execute(array($row[1]));
						$rowuser = $req2->fetch();
						echo "<div class=\"container postelement\">";
						echo "<div class=\"row\">";
						echo "<div class=\"col\">";

						if($row[1] != $_SESSION["User"]->getIdUser()){
							echo "<p class=\"font-italic\">".$_SESSION["User"]->getIdUser()." à aimé le post suivant</p>";
						}
						$user = new User($rowuser[0], $rowuser[1], $rowuser[5] , $rowuser[2] , $rowuser[3] , $rowuser[4] , $rowuser[7], $rowuser[6]);
						$icon = returnpp($user);
						echo "<div>";
						echo "<a class=\"nameidpost\" href=\"profil.php?iduser=".$row[1]."\"><img class=\"rounded-circle p-2 bd-highlight\" width=\"80px\" height=\"80px\" src=\"".$icon."\" alt=\"Profil Picture\">".$rowuser[1]." - @".$row[1]."</a>";
						$date = date_create($row[4]);
						echo "<p>".$row[2]."</p>";
						if(!is_null($row[3])){
							echo "<img class=\"rounded mx-auto d-block\"src=\"".$row[3]."\" width=\"30%\" alt=\"post image\">";
						}
						echo "<p> Le ".date_format($date, 'Y-m-d \à H:i')."</p>";
						// like et commentaire à ajouter
						echo "</div>";
						echo "</div>";
						echo "</div>";
						echo "</div>";
					}
				?>
				

			</div>
	
		</div>

		<div class="container-fluid">

			<div class="row justify-content-center">

				<div class="form-inline , d-block , d-sm-none , text-center">
                	<div class="form-group">
                    	<form method="get" action="profil.php" >
    						<label for="recherche"></label>
    						<input type="search" class="form-control" id="recherche" placeholder="Recherche Blabla't">
							<button type="submit" class="btn btn-primary">OK</button>
						</form>
                	</div>
            	</div>

			</div>

		</div>

</div>

<?php include("templates/footer.inc.php"); ?>
</body>
</html>