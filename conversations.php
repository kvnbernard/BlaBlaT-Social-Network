<!--
 Page affichant les commentaires d'un post
 -->

<?php include ("templates/head.inc.php"); ?>
  <body>
    <?php include ("templates/header.inc.php"); ?>
	<?php include("templates/nav.inc.php"); ?>
	<div id="conversation" class="containerconversations" style="padding-top:5%">
    <section class="contacts">
      <h3>Conversations</h3>
      <article>
        <h4 style="font-size:17px;">Liste de contacts</h4>
        <div id="tabs" style="overflow:auto; height:35em;">
          <ul>
	<?php
		for ($i=1;$i<=50;$i++){
			echo '<li><a href="#tabs-'.$i.'"><img class="conv-icon" src="./images/avatar.png" alt="icon"><p>Pseudo</p></a></li>';
		}   	
	?>
          </ul>
        </div>
	<div style="padding:1em">
	<img class="conv-icon" src="./images/avatar.png"><p>Pseudo utilisateur</p>
	</div>
      </article>
    </section>
    <section id="tabs-1" class="conversation-content">
      <h4 style="display:none;">blabla</h4>
      <div style="height: 50em; overflow:auto; padding:5em;">
	<?php


		for ($i=1;$i<=80;$i++){
		echo '<article>
			<h4 style="display:none;">blabla</h4>
         			 <div>DATE</div>
          			<div class="textbox">Ceci est un message court.</div>
          			<div><img class="conv-icon" src="./images/avatar.png" alt="icon"><p>pseudo</p></div>
       			 </article>';
		}
	?>
      </div>
      <article class="containerconversations">
        <h2 style="display:none;">blabla</h2>
        <input type="text" id="message_sent" name="message" class="textsend">
        <input type="button" class="button" value="Valider">
      </article>
    </section>
	</div>
    <?php include ("templates/footer.inc.php");?>
  </body>
</html>