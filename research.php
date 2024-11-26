<?php 
	session_start();
	if(empty($_SESSION["User"])){
		header("Location:index.php");
	}
 ?>
 <?php include("functions/function.inc.php"); ?>
<?php include("templates/head.inc.php"); ?>
<?php include("class/User.class.php"); ?>
<body>
<?php include("templates/header.inc.php"); ?>
<?php include("templates/nav.inc.php"); ?>

<div class="container " >
	<h2 id="soustitre">Recherche d'utilisateurs</h2>
	<div  class="row justify-content-center" >
			<div class="form-group">
				<label for="iduser">Recherche de Personnes:</label>
				<input type="text" id="iduser" name="iduser">
				
				<button id="iduserbtn" class="btn btn-primary">Rechercher</button>						
			</div>
	</div>
	<div id="researchelts">
		
	</div>

	<?php 
	/*
		if(isset($_GET["iduser"])){
			$bdd = BDconnect();
			$req = $bdd->prepare("SELECT * FROM Users WHERE id_user LIKE ?");
			$i = 0;
			$req->execute(array("%".$_GET["iduser"]."%"));
			if($req->rowCount() == 0){
				echo "<p class=\"text-center\">Aucun utilisateur ne correspond à votre recherche</p>";
			}
			else{
				while(($row = $req->fetch()) && ($i < 20)){
					$user = new User($row[0], $row[1], $row[5]);
					
					if (is_null($row[6])) {
						$user->setIcon("icons/avatar-2.png");
					}
					else{
						$user->setIcon($row[6]);
					}

					echo "<div class=\"row justify-content-center\">";
					echo "<div class=\"col-6 col-sm-8 col-xs-12  d-flex flex-row bd-highlight mb-2\">";
					echo "<img class=\"rounded-circle p-2 bd-highlight\" src=\"images/avatar-2.png\" width=\"80px\" height=\"80px\" alt=\"\">";
					echo "<a href=\"\" class=\"p-2 bd-highlight\">";
					echo "<p>".$user->getUserName()."</p>";
					echo "<p class=\"font-italic\">@".$user->getIdUser()."</p>";
					echo "</a>";
							
					echo "</div>";
					echo "</div>";
					$i++;
				}
			}
		}
		else{
			echo "<p class=\"text-center\">Erreur lors de la recherche ...</p>";
		}
		*/
	?>
	<!-- 
	<div class="row justify-content-center">
		<div class="col-6 col-sm-8 col-xs-12  d-flex flex-row bd-highlight mb-2">
			<img class="rounded-circle p-2 bd-highlight" src="images/avatar-2.png" width="80px" height="80px" alt="">
			<a href="" class="p-2 bd-highlight s-inline">
				<p>Pseudo</p>
				<p class="font-italic">@Identifiant</p>
			</a>
				
		</div>
	</div>
	-->
	
</div>

<script type="text/javascript" src="scripts/research.js"></script>
<?php include("templates/footer.inc.php"); ?>
</body>
</html>