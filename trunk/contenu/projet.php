<?php
if (isset($_SESSION["ses_connecte"]))
{
	if (isset($_GET["suprrdv"]))
	{
		if ($_GET["suprrdv"] == 1)
		{
			$q = mysql_query("SELECT * FROM rdv WHERE id='".$_SESSION["ses_rdv"]."'");
			$d = mysql_fetch_array($q);
			if ($d["id_compte_a_cree"] == $_SESSION["ses_id"])
			{
				$rdv = $_SESSION["ses_rdv"];
				mysql_query("DELETE FROM valider WHERE id_rdv=$rdv") or die("DELETE valider : ".mysql_error());
				mysql_query("DELETE FROM fichiers WHERE id_rdv_contenir=$rdv") or die("DELETE fichiers : ".mysql_error());
				mysql_query("DELETE FROM rdv WHERE id=$rdv") or die("DELETE rdv : ".mysql_error());
				$_SESSION["ses_rdv"] = null;
			}
		}
	}
$idprojet = $_SESSION["ses_projet"];
$q = mysql_query("SELECT * FROM projets WHERE id=$idprojet");

while ($d = mysql_fetch_array($q))
{
	?>
	<h2><?php echo $d['nom']; ?> : </h2>
	<p>Cree le : <?php echo $d['date']; ?> <br />
	Description : <?php echo $d['description'] ?> </p>
	<?php
}

include("affichage.php");

?>
<br />
<a href="ajoutrdv.php" title="Ajouter un rendez-vous">Ajouter un rendez-vous</a><br />

<?php
	$id_projet = $_SESSION["ses_projet"];
	$r = mysql_query("SELECT id_comptes FROM est_admin WHERE id_projets=$id_projet");
	while ($d = mysql_fetch_array($r))
	{
		if ($d["id_comptes"] == $_SESSION["ses_id"])
		{
			?> 
			<a href="index.php?idsp=<?php echo $id_projet; ?>" title="Supprimer le projet">Supprimer le projet courant</a><br /> 
			<?php
		}
	}
?>

<h3>Liste des membres affilies au projet : </h3>

<p>
<?php
$q = mysql_query("SELECT pseudo,mail FROM comptes,participer WHERE id_projets=$idprojet AND id_comptes = id");

while ($d = mysql_fetch_array($q))
{
	?>
	<span>Pseudonyme : <?php echo $d['pseudo']; ?> - Email : <?php echo $d['mail']; ?> <br /></span>
	<?php
}

?>
</p>

<?php
}
?>

