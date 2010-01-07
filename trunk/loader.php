<?php
require("req.php"); // BDD, Session, etc

if (isset($_SESSION["ses_connecte"]))
{
	if (isset($_GET['idsp']))
	{
		$id_projet_a_supprimer = $_GET['idsp'];
		$r = mysql_query("SELECT id_comptes FROM est_admin WHERE id_projets=$id_projet_a_supprimer");
		while ($d = mysql_fetch_array($r))
		{
			if ($d["id_comptes"] == $_SESSION["ses_id"])
			{
				
				mysql_query("DELETE FROM est_admin WHERE id_projets=$id_projet_a_supprimer") or die("DELETE admin : ".mysql_error());
				mysql_query("DELETE FROM valider V, rdv R WHERE V.id_rdv=R.id AND R.id_projet_posseder=$id_projet_a_supprimer") or die("DELETE valider : ".mysql_error());
				mysql_query("DELETE FROM participer WHERE id_projets=$id_projet_a_supprimer") or die("DELETE participer : ".mysql_error());
				
				mysql_query("DELETE FROM projets WHERE id=$id_projet_a_supprimer") or die("DELETE projets : ".mysql_error());
				
				mysql_query("DELETE FROM rdv WHERE id_projet_posseder=$id_projet_a_supprimer") or die("DELETE rdv : ".mysql_error());
				mysql_query("DELETE FROM fichiers WHERE id_projets_comprend=$id_projet_a_supprimer") or die("DELETE fichiers : ".mysql_error());
			}
		}
	}
}

if (isset($_POST["login"]))
{

	$pseudo = mysql_real_escape_string(htmlspecialchars($_POST["pseudo"]));
	$pass = md5("teragenda".$_POST["pass"]);
	$q = mysql_query("SELECT * FROM comptes WHERE pseudo = '".$pseudo."' AND mdp = '".$pass."'");
	echo "login".mysql_num_rows($q); 
	if (mysql_num_rows($q) >= 1)
	{
		$r = mysql_fetch_array($q);
		$_SESSION["ses_connecte"] = true;
		$_SESSION["ses_id"] = $r["id"];
		$_SESSION["ses_pseudo"] = $r["pseudo"];
	}
}

if (isset($_POST["ajoutmembre"]))
{
	$pseudo = mysql_real_escape_string(htmlspecialchars($_POST["ajoutmembre"]));
	$requete = mysql_query("SELECT id FROM comptes WHERE pseudo='".$pseudo."'") or die("SELECT id FROM comptes : " . mysql_error());
	$projet = $_SESSION["ses_projet"];
	if (mysql_num_rows($requete) >= 1)
	{
		$r =  mysql_fetch_array($requete);
		 $id_compte_ajoute = $r["id"];
		$q = mysql_query("INSERT INTO participer(id_comptes,id_projets) VALUES('$id_compte_ajoute','$projet')") or die("INSERT INTO participer" . mysql_error());
	}
	
}

if (isset($_POST["creationprojet"]))
{
	if (isset($_POST["nom"]) & isset($_POST["description"]))
	{
		date_default_timezone_set('Europe/Paris');
			
		$nom = mysql_real_escape_string(htmlspecialchars($_POST["nom"]));
		$description = mysql_real_escape_string(htmlspecialchars($_POST["description"]));
		mysql_query("INSERT INTO projets(nom,date,description) VALUES('$nom', CURDATE(), '$description')") or die("INSERT INTO projets : ".mysql_error());
		
		$q = mysql_query("SELECT id FROM projets WHERE description='$description' AND nom='$nom'") or die("SELECT FROM projets : ".mysql_error());
		$r = mysql_fetch_array($q);
		$id_projet_cree = $r["id"];
		$id = $_SESSION['ses_id'];
		mysql_query("INSERT INTO participer VALUES ('".$id."', '".$id_projet_cree."')") or die("Insertion dans Participer : ".mysql_error());
		$_SESSION["ses_projet"] = $id_projet_cree;

	}
}

	// Ajout de l'administrateur
	if (isset($_POST["creationprojet"]))
	{
		if (isset($_POST["nom"]) & isset($_POST["description"]))
		{
			$id_admin = $_SESSION['ses_id'];
			$id_projet_cree = $_SESSION['ses_projet'];
		
			mysql_query("INSERT INTO est_admin(id_comptes, id_projets) VALUES ('$id_admin', '$id_projet_cree')") or die("INSERT INTO admin : ".mysql_error());
		}
	}
	


?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
   <head>
       <title>Super Agenda</title>
       <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
       <link rel="stylesheet" media="screen" type="text/css" href="design.css" />
   </head>

   <body>
     <div id="banniere">
		<a href="index.php" title="Lien vers la page principale"><img src="./image/header.png" alt="En tete Header" /></a>
     </div>
     
     <div id="barreup">
     	<ul>
     		<li><a href="./index.php" title="Lien vers la page d'accueil">Accueil</a></li>
    	 </ul>
     </div>
	 
	 <div id="cadreconnexion">
	 <form method="post" action="">
	 <?php
if (isset($_SESSION["ses_connecte"]))
{
	?>
	 	 <p> Pseudonyme : <?php echo $_SESSION["ses_pseudo"]; ?> <br />
		 <input type="hidden" name="deco" value="1" />
	 <input type="submit" value="Se deconnecter" /></p>
	 <?php
}
else
{
	?>
	 <p>
		<input type="hidden" name="login" value="1" />
		Pseudonyme : <input type="text" name="pseudo" /> <br />
	 Mot de passe : <input type="password" name="pass" /> <br />
	 <input type="submit" value="Se connecter" /><br />
	 <a href="./register.php" title="Enregistrement">S'enregistrer</a>
	 </p>
	 <?php
}

?>
	 </form>
	 </div>
	 
	 <?php
	 if (isset($_SESSION["ses_connecte"]))
	 {
	 if (isset($_GET["projet"]))
	 {
		$id = $_SESSION["ses_id"];
		$p = mysql_real_escape_string($_GET["projet"]);
		$q = mysql_query("SELECT * FROM participer, projets WHERE id=id_projets AND id_comptes='$id' AND id_projets='$p'");
		if (mysql_num_rows($q) == 1)
		{
			$_SESSION["ses_projet"] = $p;
		}
	 }
	 
	 	?>
	 	<div id="gestion_projets">
		 <form method="post" action="">
	 	<h4>Gestion des projets :</h4>
	 	<ol>
	 	<?php
	 		$id = $_SESSION["ses_id"];
	 		$r = mysql_query("SELECT * FROM participer, projets WHERE id=id_projets AND id_comptes=$id");
	 		while ($q = mysql_fetch_array($r))
	 		{
				if (isset($_SESSION["ses_projet"]) && $q["id"] == $_SESSION["ses_projet"])
				{
	 			?>
	 				<li><a href="projet.php">[<?php echo $q['nom']; ?>]</a></li>
	 			<?php
				}
				else
				{
	 			?>
	 				<li><a href="projet.php?projet=<?php echo $q['id']; ?>"><?php echo $q['nom']; ?></a></li>
	 			<?php
				}
	 		}
	 	?>
	 	</ol>
		<p>
	 	<br /><a href="./creationprojet.php" title="Creation Projet">Nouveau projet</a>
	 	</p></form>
	 	</div>
	 	<?php
	 }
	 

	if (isset($_SESSION["ses_connecte"]))
	{
		if (isset($_SESSION["ses_projet"]))
		{
			$id = $_SESSION["ses_id"];
			$id_projet = $_SESSION["ses_projet"];
			?>
			<div id="gestion_membres">
			
			<h4>Membres affili&eacute;s au projet 
			<?php 
			$nom_projet = mysql_query("SELECT nom FROM projets WHERE id=$id_projet") or die("Nom Projet : " . mysql_error());
			while ($j = mysql_fetch_array($nom_projet))
			{
				echo $j["nom"];
			}
			?>
			
			</h4>
			
			<ol>
			<?php
				$id = $_SESSION["ses_id"];
				$r = mysql_query("SELECT pseudo FROM comptes C,participer P WHERE C.id = P.id_comptes AND P.id_projets=$id_projet") or die("Requete membres : " . mysql_error());
				while ($q = mysql_fetch_array($r))
				{
					echo $q["pseudo"]; echo "<br />";
				}
			?>
			</ol>		
			
			<form method="post" action="">
			<h5>Ajouter un membre</h5>
			<p>
				<input type="text" name="ajoutmembre" />
				<input type="submit" />
			</p>
			</form>
			</div>
			<?php
		}
	}
	 ?>
	 


	 <div id="presentationagenda">
	<?php
		include("contenu/".$page.".php");
	?>
	</div>
    	
  </body>
</html>
