<?php
session_start();
if (isset($_POST['deco']))
{
	session_unset();
	session_destroy();
	session_start();
}
$sql = mysql_connect("10.10.1.12","bergere","votre_passwd");
mysql_select_db("bergere",$sql);

if (isset($_POST["pseudo"]))
{
	$pseudo = mysql_real_escape_string($_POST["pseudo"]);
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
		<a href="index.php" title="Lien vers la page principale"><img src="" alt="En tete Header" /></a>
     </div>
	 
	 <div id="cadreconnexion">
	 <form method="post" action="">
	 <?php
	 if ($_SESSION["ses_connecte"] == true)
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
	 <p> Pseudonyme : <input type="text" name="pseudo" /> <br />
	 Mot de passe : <input type="password" name="pass" /> <br />
	 <input type="submit" value="Se connecter" /></p>
	 <?php
	 }
	 ?>
	 </form>
	 </div>
	 
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