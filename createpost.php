<?php 
	session_start();
	if(empty($_SESSION["User"])){
		header("Location:index.php");
	}
 ?>
<?php include ("templates/head.inc.php"); ?>
 	<body>
    <?php include ("templates/header.inc.php"); ?>
	<?php include("templates/nav.inc.php"); ?>

	<h2 id="soustitre" class="text-center">Votre post !</h2>
	<div class="container">
		<div class="row justify-content-center">
			<form class=" align-items-center col-12 col-md-6 col-sm-12 col-xs-12 form-group"  action="functions/addpost.php" method="post" enctype="multipart/form-data">
				<div>
					<label for="message" class="form-control-lg">Votre message : </label>
					<textarea class="form-control" name="message" id="message" cols="30" rows="5" aria-describedby="msg"></textarea>
					<small id="msg" class="form-text text-muted"><span id="undertext">Pas plus de 300 caractères ! / <span id="nbcara">300</span> restants</span></small>
				</div>
				<div>
					<label for="image" >Ajouter une image :</label>
					<input type="file" name="image" id="image">
				</div>
				<input type="submit" id="submit" value="Écrire un nouveau post !">
			</form>
		</div>
	</div>




	<script type="text/javascript" src="scripts/postnbcara.js"></script>
	<?php include ("templates/footer.inc.php");?>
	</body>
</html>