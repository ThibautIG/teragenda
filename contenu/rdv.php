<?php
$_SESSION["ses_rdv"] = mysql_real_escape_string($_GET["rdv"]);
	if (isset($_POST["date"]))
	{
		$date = mysql_real_escape_string($_POST["date"]);
		$heuredeb = mysql_real_escape_string($_POST["heuredeb"]);
		$heurefin = mysql_real_escape_string($_POST["heurefin"]);
		$commentaire = mysql_real_escape_string($_POST["commentaire"]);
		mysql_query("UPDATE rdv SET date='".$date."', heuredeb='".$heuredeb."', heurefin='".$heurefin."', commentaire='".$commentaire."' WHERE id='".$_SESSION["ses_rdv"]."'",$sql) or die("UPDATE rdv : ".mysql_error());
	}
$q = mysql_query("SELECT * FROM rdv WHERE id='".$_SESSION["ses_rdv"]."'");
$d = mysql_fetch_array($q);
if ($d["id_projet_posseder"] == $_SESSION["ses_projet"])
{

	?><h1>Rendez-vous</h1>
	<?php
	if ($d["id_compte_a_cree"] == $_SESSION["ses_id"])
	{
	?>
	<form method="post" action="">
		<table>
			<tr><td><label>Date</label></td><td><input type="text" id="date" name="date" value="<?php echo $d["date"]; ?>" /></td></tr>
			<tr><td><label>Heure D&eacute;but</label></td><td><input type="text" id="heure" name="heuredeb" value="<?php echo $d["heuredeb"]; ?>" /></td></tr>
			<tr><td><label>Heure Fin</label></td><td><input type="text" id="duree" name="heurefin" value="<?php echo $d["heurefin"]; ?>" /></td></tr>
			<tr><td><label>Commentaire</label></td><td><input type="text" id="commentaire" name="commentaire" value="<?php echo $d["commentaire"]; ?>" /></td></tr>
			
		</table>
		<p style="text-align: center;">
			<input type="submit" value="Modifier"/><input type="reset" value="Effacer"/><br />
		</p>
	</form>
	<?php
	}
	else
	{
		echo $d["date"]."<br />";
		echo $d["heuredeb"]."<br />";
		echo $d["heurefin"]."<br />";
		echo $d["commentaire"]."<br />";
	}
?>

<p>Liste des fichiers :</p>
<?php
$q = mysql_query("SELECT *, C.id as compte_id, F.id as fichier_id FROM fichiers F, comptes C WHERE F.id_comptes_envoyer = C.id AND F.id_rdv_contenir = ".$_SESSION["ses_rdv"]) or die("select fichiers : ".mysql_error());
while ($d = mysql_fetch_array($q) )
{
?><a href="fichiers/<?php echo $d["nom"]; ?>"><?php echo $d["description"]; ?></a><?php if ($d["compte_id"] == $_SESSION["ses_id"])
{
?>
 - <a href="rdv.php?deletefichier=<?php echo $d["fichier_id"]; ?>">Supprimer le fichier</a>
<?php
}
?><br /><?php


}
?>
<a href="ajoutfichier.php">Ajouter un fichier</a><?php

}
else
{
	echo "Ce RDV n'est pas dans le projet selectionné.";
}


?>