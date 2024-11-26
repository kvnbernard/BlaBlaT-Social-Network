<?php 
include("function.inc.php");
include("../class/User.class.php");

if(isset($_GET["iduser"])){
			$bdd = BDConnect();
			$req = $bdd->prepare("SELECT * FROM Users WHERE id_user LIKE ?");
			$i = 0;
			$req->execute(array("%".$_GET["iduser"]."%"));
			if($req->rowCount() == 0){
				echo "<p class=\"text-center\">Aucun utilisateur ne correspond à votre recherche</p>";
			}
			else{
				while(($row = $req->fetch()) && ($i < 20)){
					$user = new User($row[0], $row[1], $row[5] , $row[2] , $row[3] , $row[4] , $row[7], $row[6]);
					
					if (is_null($row[6])) {
						$user->setIcon("avatar-2.png");
						$icon = "./icons/avatar-2.png";
					}
					else{
						$user->setIcon($row[6]);
						$icon = "./icons/".$row[6];
					}

					echo "<div class=\"row justify-content-center\">";
					echo "<div class=\"col-6 col-sm-8 col-xs-12  d-flex flex-row bd-highlight mb-2\">";
					echo "<img class=\"rounded-circle p-2 bd-highlight\" src=".$icon." width=\"80px\" height=\"80px\" alt=\"Profile picture\">";
					echo "<a href=\"profil.php?iduser=".$user->getIdUser()."\" class=\"p-2 bd-highlight\">";
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

/*
if(isset($_GET["iduser"])){
$bdd = BDconnect();
			$req = $bdd->prepare("SELECT * FROM Users WHERE id_user LIKE ?");
			$i = 0;
			$returnval = " ";
			$req->execute(array("%".$_GET["iduser"]."%"));
			if($req->rowCount() == 0){
				$returnval.= "<p class=\"text-center\">Aucun utilisateur ne correspond à votre recherche</p>";
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

					$returnval.=  "<div class=\"row justify-content-center\">";
					$returnval.=  "<div class=\"col-6 col-sm-8 col-xs-12  d-flex flex-row bd-highlight mb-2\">";
					$returnval.=  "<img class=\"rounded-circle p-2 bd-highlight\" src=\"images/avatar-2.png\" width=\"80px\" height=\"80px\" alt=\"\">";
					$returnval.=  "<a href=\"\" class=\"p-2 bd-highlight\">";
					$returnval.=  "<p>".$user->getUserName()."</p>";
					$returnval.=  "<p class=\"font-italic\">@".$user->getIdUser()."</p>";
					$returnval.=  "</a>";
							
					$returnval.=  "</div>";
					$returnval.=  "</div>";
					$i++;
				}
			}
			echo '<p>oui</p>';
			return $returnval;
		}
		else{
			$returnval =  "<p class=\"text-center\">Erreur lors de la recherche ...</p>";
			return $returnval;
		}
*/


?>