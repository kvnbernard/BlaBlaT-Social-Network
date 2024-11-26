<!--
 Page affichant le fil d'actualité du site
 ie l'ensemble des posts suivis
 -->
<?php require_once("functions/function.inc.php"); ?>
<?php require_once("class/User.class.php"); ?>
<?php require_once("class/Post.class.php"); ?>
<?php require_once("class/Like.class.php"); ?>
<?php include("templates/head.inc.php"); ?>
<?php 
	session_start();
	if(empty($_SESSION["User"])){
		header("Location:index.php");
	}
 ?>

<style>
.btn-circle{
  width: 1.875rem;
  height: 1.875rem;
  text-align: center;
  padding: 0.375rem 0;
  font-size: 0.75rem;
  line-height: 1.428571429;
  border-radius: 0.938rem;
}
.btn-circle.btn-lg{
  width: 3.125rem;
  height: 3.125rem;
  padding: 0.625rem 1rem;
  font-size: 1.125rem;
  line-height: 1.33;
  border-radius: 1.563rem;
}
</style>
	<?php include ("templates/header.inc.php"); ?>
	
	<?php include("templates/nav.inc.php"); ?>
	
	<h2 id="soustitre">Fil d'actualité</h2>
	<a class="btn rounded-circle researchbutton" href="research.php"title="Rechercher un utilisateur"><svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="white" xmlns="http://www.w3.org/2000/svg" > 
					  <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
					  <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/></svg>
</a>

<a class="btn rounded-circle messagebutton" style="padding-top: 0.5em; padding-bottom: 0.5em;" href="createpost.php" title="Ecrire un message">
	<span class="fa fa-comment"></span>
</a>
	
	<input id="iduser" name="iduser" type="hidden" value="<?php echo $_SESSION['User']->getIdUser()?>">
	<div id="postelts">

	</div>
	<script type="text/javascript" src="./scripts/postsndcomments.js"></script>
	<script type="text/javascript" src="./scripts/likeanimation.js"></script>

	<?php include ("templates/footer.inc.php"); ?>
</body>
</html>