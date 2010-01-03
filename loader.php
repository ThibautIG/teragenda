<?php
session_start();
if (isset($_POST['deco']))
{
	session_unset();
	session_destroy();
	session_start();
}
$sql = mysql_connect("localhost","root","");
mysql_select_db("agenda",$sql);

if (isset($_POST["login"]))
{
	$pseudo = mysql_real_escape_string(htmlspecialchars($_POST["pseudo"]));
	$pass = md5("teragenda".$_POST["pass"]);
	$q = mysql_query("SELECT * FROM comptes WHERE pseudo = '".$pseudo."' AND mdp = '".$pass."'");
	if (mysql_num_rows($q) == 1)
	{
		$r = mysql_fetch_array($q);
		$_SESSION["ses_connecte"] = true;
		$_SESSION["ses_id"] = $r["id"];
		$_SESSION["ses_pseudo"] = $r["pseudo"];
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
	 if (isset($_SESSION["ses_connecte"]))
	 {
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
	 ?>
	 
	 
	 <div id="presentationagenda">
	<?php
include("contenu/".$page.".php");
?>
	</div>
	

    	 <div id="footer">
    	      <div id="footer_texte">
	      	   <a href="aide.php" title="Aide Site">Aide</a>
		   <span>&nbsp;-&nbsp;</span>
		   <a href="faq.php" title="Faq">FAQ</a>
     	      	       	      	   
     	      	  


	<span>&nbsp;-&nbsp;</span>

 	<a href="plansite.php" title="Plan du site">Plan Site</a>



     	      </div>
	 </div>	
  </body>
</html>