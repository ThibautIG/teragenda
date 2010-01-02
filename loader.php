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
     		<li><a href="./ajoutrdv.php" title="Ajout RDV">Ajout RDV</a></li>
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
	 	?>
	 	<div id="gestion_projets">
		 <form method="post" action="">
	 	<h4>Gestion des projets :</h4>
	 	<ul>
	 	<?php
	 		$id = $_SESSION["ses_id"];
	 		$requete = mysql_query("SELECT id_comptes FROM participer WHERE id_comptes=$id LIMIT 0,5");
	 		while ($q = mysql_fetch_array($requete))
	 		{
	 			?>
	 				<li><?php echo $q['id_projets']; ?></li>
	 			<?php
	 		}
	 	?>
	 	<br /><a href="./creationprojet.php" title="Creation Projet">Nouveau projet</a>
	 	</form>
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