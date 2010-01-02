<?php
if (isset($_SESSION["ses_connecte"]))
{
?>

<?php
if (isset($_POST["nom"]) & isset($_POST["description"]))
{
	date_default_timezone_set('Europe/Paris');
		
	$date = date('d/m/Y');
	$nom = mysql_real_escape_string(htmlspecialchars($_POST["nom"]));
	$description = mysql_real_escape_string(htmlspecialchars($_POST["description"]));
	$ok = mysql_query("INSERT INTO projets VALUES ('', ".$nom.", ".$date.", ".$description.")") or die("Insertion des donnees : ".mysql_error());
	
	$id_projet_cree = ("SELECT id_projet FROM projets WHERE description=$description AND nom=$nom") or die("Recuperation ID_Projet : ".mysql_error());
	
	$id = $_SESSION['id'];
	$ok2 = mysql_query("INSERT INTO participer VALUES ('".$id."', '".$id_projet_cree."')") or die("Insertion dans Participer : ".mysql_error());
	
	if ($ok && $ok2)
	{
		echo "Projet ajoute";
	}
	else 
	{
		echo "Erreur";
	}
}
?>

<h3>Creation d'un projet</h3>
<form method="post" action="./creationprojet.php">

<table>
		<tr><td><label>Nom du projet : </label></td><td><input type="text" id="nom" name="nom" /></td></tr>
		<tr><td><label>Description : </label></td><td><input type="text" id="description" name="description" /></td></tr>
</table>	
	
	<p style="text-align: center;">
		<input type="submit" value="Envoyer"/><input type="reset" value="Effacer"/>
	</p>
	
	
<?php
}
?>