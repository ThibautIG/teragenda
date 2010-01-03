<?php
$idprojet = mysql_real_escape_string($_GET["id"]);
$q = mysql_query("SELECT * FROM projets WHERE id=$idprojet");

while ($d = mysql_fetch_array($q))
{
	?>
	<h2><?php echo $d['nom']; ?> : </h2>
	<p>Cree le : <?php echo $d['date']; ?> <br />
	Description : <?php echo $d['description'] ?> </p>
	<?php
}

include("./contenu/affichage.php");

?>

<a href="ajoutrdv.php" title="Ajouter un rendez-vous">Ajouter un rendez-vous</a>


<h3>Liste des membres affilies au projet : </h3>

<p>
<?php
$q = mysql_query("SELECT pseudo,mail FROM comptes,participer WHERE id_projets=$idprojet");

while ($d = mysql_fetch_array($q))
{
	?>
	<span>Pseudonyme : <?php echo $d['pseudo']; ?> - Email : <?php echo $d['mail']; ?> <br /></span>
	<?php
}
?>
</p>



