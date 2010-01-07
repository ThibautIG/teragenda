<?php
if (isset($_GET["rdv"]))
{
	$_SESSION["ses_rdv"] = mysql_real_escape_string($_GET["rdv"]);
}
if (isset($_POST["date"]))
{
	$date = mysql_real_escape_string($_POST["date"]);
	$heuredeb = mysql_real_escape_string($_POST["heuredeb"]);
	$heurefin = mysql_real_escape_string($_POST["heurefin"]);
	$commentaire = mysql_real_escape_string($_POST["commentaire"]);
	mysql_query("UPDATE rdv SET date='".$date."', heuredeb='".$heuredeb."', heurefin='".$heurefin."', commentaire='".$commentaire."' WHERE id='".$_SESSION["ses_rdv"]."'",$sql) or die("UPDATE rdv : ".mysql_error());
}

if (isset($_GET["valider"]))
{
	if ($_GET["valider"] == 0)
	{
		mysql_query("DELETE FROM valider WHERE id_comptes='".$_SESSION["ses_id"]."' AND id_rdv='".$_SESSION["ses_rdv"]."'",$sql) or die("REMOVE valider : ".mysql_error());
	}
	if ($_GET["valider"] == 1)
	{
		mysql_query("INSERT INTO valider(id_comptes,id_rdv) VALUES('".$_SESSION["ses_id"]."','".$_SESSION["ses_rdv"]."')",$sql) or die("INSERT valider : ".mysql_error());
	}
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
			<a href="projet.php?suprrdv=1">Supprimer ce RDV</a>
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

$q = mysql_query("SELECT * FROM valider WHERE id_comptes='".$_SESSION["ses_id"]."' AND id_rdv='".$_SESSION["ses_rdv"]."'") or die("select participer : ".mysql_error());
if (mysql_num_rows($q) > 0)
{
?>Vous avez validé. <a href="rdv.php?valider=0">Ne plus valider</a><?php
}
else
{
?>Vous n'avez pas validé. <a href="rdv.php?valider=1">Valider</a><?php
}

// LISTE des comptes

    $id = $_SESSION["ses_id"];
	$projet = $_SESSION["ses_projet"];
	$r_pseudo = mysql_query("SELECT pseudo, id, mail FROM comptes C,participer P WHERE C.id = P.id_comptes AND P.id_projets=$id_projet") or die("Requete membres : " . mysql_error());
	?><p>Liste membres :</p><?php
	while ($d = mysql_fetch_array($r_pseudo))
	{
		echo "<br />";
		$q = mysql_query("SELECT * FROM valider WHERE id_rdv='".$_SESSION['ses_rdv']."' AND id_comptes='".$d['id']."'");
		echo $d['pseudo'];
		if (mysql_num_rows($q) > 0)
		{
			echo " a validé";
		}
		else
		{
			echo " n'a pas validé";
		}
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
<a href="ajoutfichier.php">Ajouter un fichier</a><br />



<?php
	


}
else
{
	echo "Ce RDV n'est pas dans le projet selectionné.";
}


?>