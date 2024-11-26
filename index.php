<!--
Page d'accueil permettant la connexion ainsi que la création de compte
 -->

<?php include("templates/head.inc.php"); ?>

<body>
	<?php include("templates/header.inc.php"); ?>
	<div class="container-fluid">
		<div class="row">
			<article class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				<h2 class="text-center slogant"> Redécouvrez comment discuter ! </h2>
				<div class="modal-dialog modal-login shadow p-3 mb-5 bg-white">
					<div class="modal-content">
						<div class="modal-header">
							<div class="avatar">
								<img src="images/avatar-2.png" alt="Avatar">
							</div>
							<h4 class="modal-title">Connexion</h4>
						</div>
					<div class="modal-body">
						<form method="post" action="functions/connexion.php">
							<div class="form-group">
								<input class="form-control" type="text" name="identifiant" id="identifiant" placeholder="Identifiant" required="required"/>
							</div>
							<div class="form-group">
								<input class="form-control" type="password" name="mdp" id="mdp" placeholder="Mot de passe" required="required"/>
							</div>
							<div class="form-group">
								<input class="btn btn-primary btn-lg btn-block login-btnn" type="submit" value="Se connecter">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<a id="toCreateAccount" href="#createaccount">Créer un compte</a>
					</div>
				</div>
			</div>
			</article>
			<article class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pr-0 pt-3">
				<img  class="img-fluid" src="images/womenChatting.jpg"  alt="Discussion">
			</article>
		</div>
	</div>

	<div class="container-fluid connexionillustrationtexts">
		<h3 class="text-center">Notre réseau social</h3>
		<div class="row justify-content-center">
			<div class="col-sm-3 col-xs-12 text-justify indextext">
				Blabla't est un réseau social qui vous permet de dire ce que vous pensez, de partager une envie, une expérience ou une émotion. Si vous choisisez de créer un compte vous avez la possibilité d'accéder à un fil d'actualité déroulant, de poster un message de taille limitée avec éventuellement une image. Vous pouvez également mentionner des utilisateurs avec leur identifiant.
			</div>
			<div class="col-sm-3 col-xs-12 text-justify indextext">
				L'ergonomie de Blabla't a été pensé de telle sorte que l'ensemble des éléments soient facilement accessibles et lisibles pour tous les utilisateurs. L'interface est avant tout composé d'un fil d'actualité qui affiche l'ensemble des posts des personnes que vous suivez ainis que les posts aimés des autres personnes que vous suivez. Vous avez également accès aux différentes options comme la recherche d'autres utilisateurs et aux informations de votre compte à l'aide d'un menu facilement accessible. 
			</div>
			<div class="col-sm-3 col-xs-12 text-justify indextext">
				Selon les critères, thèmes que vous avez renseigné dans votre profil Blabla't est capable de vous suggérer des personnes à suivre créant ainsi du contenu dans vos thèmes. 
				<p class="lead"> Si vous avez envie de découvrir Blabla't n'hésitez pas à <strong> créer un compte ci-dessous ! <strong> </p>
			</div>
		</div>
	</div>
	
	<div class="container-fluid justify-content-center">
		<h3 class="text-center">Créer votre compte dès maintenant !</h3>
		<div class="row justify-content-center">
			<form id="createaccount" class="col-6 modal-body " method="post" action="functions/accountcreation.php">
				<div class="form-group ">
					<input class="form-control" placeholder="Identifiant" name="idcreation" type="text" required="required">
				</div>
				
				<div class="form-group">
					<input class="form-control" placeholder="Pseudo" name="pseudocreation" type="text" required="required">
				</div>
				
				<div class="form-group">
					<input class="form-control" placeholder="Nom de Famille" name="nomcreation" type="text" required="required">
				</div>

				<div class="form-group">
					<input class="form-control" placeholder="Prenom" name="prenomcreation" type="text" required="required">
				</div>

				<div class="form-group">
					<input class="form-control" placeholder="Mot de passe" name="mdpcreation" type="password" required="required">
				</div>

				<div class="form-group">
					<input class="form-control" placeholder="Adresse Mail" name="mailcreation" type="text" required="required">
				</div>

				<p class="form-group">
					<label for="birthdatecreation">Date de Naissance : </label>
					<input class="form-control" id="birthdatecreation" name="birthdatecreation" type="date" required="required">
				</p>
				<p class="text-center">
					<input class="btn  createaccountbtn" type="submit" value="Creer votre compte !">
				</p>
				
			</form>
		</div>
	</div>
	<?php include("templates/footer.inc.php"); ?>
</body>
</html>